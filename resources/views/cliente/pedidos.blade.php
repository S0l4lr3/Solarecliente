@extends('layouts.cliente')

@section('title', 'Mis Pedidos')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        {{-- Encabezado --}}
        <div style="margin-bottom: 4rem; border-bottom: 1px solid var(--color-sand-beige); padding-bottom: 2rem;">
            <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">Mis Pedidos</h1>
            <p style="font-size: 19px; text-transform: uppercase; letter-spacing: 2px; color: var(--color-clay-brown); font-weight: 700;">Historial de tus adquisiciones exclusivas</p>
        </div>

        @if(count($pedidos) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--color-dark-moss);">
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999;"># Pedido</th>
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999;">Fecha</th>
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999;">Detalles de Compra</th>
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999; text-align: center;">Estado Pago</th>
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999; text-align: center;">Estado Envío</th>
                            <th style="padding: 20px 10px; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; color: #999; text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 30px 10px; font-size: 20px; font-weight: 700; color: var(--color-dark-moss);">
                                    #{{ str_pad($pedido['id'], 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td style="padding: 30px 10px; font-size: 18px; color: #666;">
                                    {{ date('d/m/Y', strtotime($pedido['fecha'])) }}
                                </td>
                                <td style="padding: 30px 10px;">
                                    @foreach($pedido['items'] as $item)
                                        <div style="margin-bottom: 10px;">
                                            <span style="display: block; font-size: 18px; font-weight: 600; color: #333;">{{ $item['producto'] }}</span>
                                            <span style="font-size: 14px; color: #999; text-transform: uppercase;">Color: {{ $item['color'] }} | Cantidad: {{ $item['cantidad'] }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td style="padding: 30px 10px; text-align: center;">
                                    <span style="padding: 8px 15px; border-radius: 20px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; 
                                        {{ $pedido['estado_pago'] == 'completado' ? 'background: #f0fdf4; color: #166534;' : 'background: #fef2f2; color: #991b1b;' }}">
                                        {{ $pedido['estado_pago'] }}
                                    </span>
                                </td>
                                <td style="padding: 30px 10px; text-align: center;">
                                    <span style="font-size: 16px; font-weight: 600; color: var(--color-clay-brown); text-transform: capitalize;">
                                        {{ str_replace('_', ' ', $pedido['estado_envio']) }}
                                    </span>
                                </td>
                                <td style="padding: 30px 10px; text-align: right; font-size: 22px; font-weight: 700; color: #333;">
                                    ${{ number_format($pedido['total_pedido'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 10rem 0; border: 1px dashed var(--color-sand-beige);">
                <h3 class="serif" style="font-size: 2rem; color: #ccc; margin-bottom: 1rem;">Aún no tienes pedidos</h3>
                <p style="font-size: 16px; color: #999; margin-bottom: 3rem;">Tus futuras piezas de mobiliario aparecerán aquí una vez que realices una compra.</p>
                <a href="/catalogo" class="btn btn-primary" style="width: auto; padding: 15px 40px; font-size: 14px;">Explorar Colección</a>
            </div>
        @endif

    </div>
</div>

@endsection