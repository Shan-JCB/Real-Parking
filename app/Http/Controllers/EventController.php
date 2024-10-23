<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Parqueo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Verificar si ya hay un evento en curso para la placa
            $eventoExistente = Event::where('placa', $request->placa)
                ->where('proceso', 'En curso')
                ->first();

            if ($eventoExistente) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El vehículo con esta placa ya está en un evento en curso.'
                ]);
            }

            // Verificar si el parqueo está ocupado
            $parqueoOcupado = Event::where('parqueo_id', $request->parqueo_id)
                ->where('proceso', 'En curso')
                ->first();

            if ($parqueoOcupado) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El parqueo seleccionado está actualmente en uso.'
                ]);
            }

            // Creación de un nuevo evento
            $evento = new Event();
            $evento->placa = $request->placa;
            $evento->parqueo_id = $request->parqueo_id;
            $evento->operador_id = $request->operador_id;
            $evento->proceso = 'En curso'; // Establecer proceso en "En curso"
            $evento->save();

            // Actualizar el estado del parqueo a "OCUPADO"
            $parqueo = Parqueo::find($request->parqueo_id);
            $parqueo->estado = 'OCUPADO';
            $parqueo->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Evento registrado exitosamente!',
                'evento_id' => $evento->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al registrar el evento: ' . $e->getMessage()
            ]);
        }
    }

    public function finalizarEvento($id)
    {
        try {
            $evento = Event::find($id);

            if (!$evento) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Evento no encontrado.'
                ]);
            }

            // Actualizar el evento a "Finalizado"
            $evento->proceso = 'Finalizado';
            $evento->save();

            // Liberar el parqueo
            $parqueo = Parqueo::find($evento->parqueo_id);
            $parqueo->estado = 'LIBRE';
            $parqueo->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Evento finalizado exitosamente!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al finalizar el evento: ' . $e->getMessage()
            ]);
        }
    }


    public function printTicket($id)
    {
        // Obtener la información del evento
        $evento = Event::with(['cliente', 'operador', 'parqueo'])->findOrFail($id);

        // Generar el PDF con tamaño personalizado (80mm x 150mm)
        $pdf = PDF::loadView('ticket', compact('evento'))->setPaper([0, 0, 300, 350], 'portrait');

        // Devolver el PDF como una vista
        return $pdf->stream('ticket_parqueo.pdf');
    }

    public function destroy($id)
    {
        try {
            // Buscar el evento correspondiente
            $evento = Event::where('parqueo_id', $id)->firstOrFail();

            // Eliminar el evento
            $evento->delete();

            // Cambiar el estado del parqueo a "LIBRE"
            $parqueo = Parqueo::find($id);
            $parqueo->estado = 'LIBRE';
            $parqueo->save();

            return redirect()->back()->with([
                'mensaje' => 'Ingreso cancelado y estado actualizado a LIBRE.',
                'icono' => 'success',
                'titulo' => 'Éxito'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'mensaje' => 'Error al cancelar el ingreso: ' . $e->getMessage(),
                'icono' => 'error',
                'titulo' => 'Error'
            ]);
        }
    }
}
