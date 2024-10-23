<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pago;
use App\Models\Parqueo;
use App\Models\Tarifa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $pagos = Pago::with('evento.cliente')->get();
        return view('admin.pagos.index', compact('pagos'));
    }

    public function procesarPago(Request $request)
    {
        try {
        // Validar los datos recibidos
        $request->validate([
            'tarifa_id' => 'required|exists:tarifas,id',
            'evento_id' => 'required|exists:events,id',
            'parqueo_id' => 'required|exists:parqueos,id',
        ]);

        // Obtener el evento en curso
        $evento = Event::find($request->evento_id);

        // Verificar si el evento es válido y está en curso
        if (!$evento || $evento->proceso !== 'En curso') {
            return redirect()->back()->with('error', 'Evento no encontrado o ya finalizado.');
        }

        // Obtener la tarifa seleccionada
        $tarifaSeleccionada = Tarifa::find($request->tarifa_id);

        // Calcular el tiempo de ocupación
        $fechaIngreso = $evento->created_at;
        $fechaActual = now();
        $tiempoOcupacion = $fechaIngreso->diffInMinutes($fechaActual);

        $tarifaInicial = $tarifaSeleccionada->monto;

        if ($tiempoOcupacion < $tarifaSeleccionada->periodo) {
            $total = $tarifaInicial;
        } else {

            $minutosExtra = $tiempoOcupacion - $tarifaSeleccionada->periodo;

            $total = $tarifaInicial + ($minutosExtra / $tarifaSeleccionada->periodo) * $tarifaSeleccionada->monto;
        }

        // Crear el pago
        $pago = new Pago();
        $pago->evento_id = $evento->id;
        $pago->tarifa_id = $tarifaSeleccionada->id;
        $pago->tiempo_ocupacion = $tiempoOcupacion;
        $pago->tarifa = $tarifaSeleccionada->monto;
        $pago->total = $total;
        $pago->save();

        // Cambiar el estado del parqueo a 'LIBRE'
        $parqueo = Parqueo::find($request->parqueo_id);
        $parqueo->estado = 'LIBRE';
        $parqueo->save();

        // Cambiar el estado del evento a 'Finalizado'
        $evento->proceso = 'Finalizado';
        $evento->save();
        

        return response()->json([
            'status' => 'success',
            'message' => 'Pago Realizado Correctamente!',
            'icono' => 'success',
            'titulo' => 'Operación Exitosa!',
        ]);
        

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function imprimirFactura($id)
{
    $pago = Pago::with('evento.cliente')->findOrFail($id);
    $evento = Event::with(['cliente', 'operador', 'parqueo'])->findOrFail($id);
    
    // Generar el PDF usando una vista
    $pdf = PDF::loadView('factura', compact('pago', 'evento'))->setPaper([0, 0, 300, 350], 'portrait');

    // Retornar el PDF
    return $pdf->stream('factura_' . $pago->id . '.pdf'); // O usar ->download() si deseas que se descargue.
}

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $pago = Pago::find($id);
        $pago->delete();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Se Eliminó Registro!')
            ->with('icono', 'success')
            ->with('titulo', 'Operación Exitosa!');
    }
}
