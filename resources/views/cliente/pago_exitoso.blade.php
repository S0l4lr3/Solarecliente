@extends('layouts.cliente')

@section('title', '¡Pago Exitoso!')

@section('content')

<div class="container" style="margin-top: 5rem; margin-bottom: 7rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        
        {{-- Ícono de Éxito --}}
        <div style="margin-bottom: 2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#166534" viewBox="0 0 16 16" style="background: #f0fdf4; padding: 20px; border-radius: 50%;">
                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
            </svg>
        </div>

        <h1 class="serif" style="font-size: 3.5rem; color: var(--color-dark-moss); margin-bottom: 1rem;">¡Gracias por tu compra!</h1>
        <p style="font-size: 20px; color: #666; margin-bottom: 4rem;">Tu pago ha sido procesado correctamente. Hemos enviado un correo con los detalles de tu pedido.</p>

        @if($pedido)
            {{-- Detalle del Pedido Recién Pagado --}}
            <div style="background: #fafafa; border: 1px solid var(--color-sand-beige); border-radius: 8px; padding: 3rem; text-align: left; margin-bottom: 4rem;">
                <div style="display: flex; justify-content: space-between; border-bottom: 2px solid var(--color-sand-beige); padding-bottom: 1.5rem; margin-bottom: 2rem;">
                    <h2 class="serif" style="font-size: 1.8rem;">Pedido #{{ str_pad($pedido['id'], 5, '0', STR_PAD_LEFT) }}</h2>
                    <span style="font-size: 16px; font-weight: 700; color: #166534; text-transform: uppercase; letter-spacing: 1px; background: #f0fdf4; padding: 5px 15px; border-radius: 20px;">Pagado</span>
                </div>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid #eee;">
                            <th style="padding: 10px 0; font-size: 14px; text-transform: uppercase; color: #999; text-align: left;">Producto</th>
                            <th style="padding: 10px 0; font-size: 14px; text-transform: uppercase; color: #999; text-align: center;">Cant.</th>
                            <th style="padding: 10px 0; font-size: 14px; text-transform: uppercase; color: #999; text-align: right;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido['items'] as $item)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 20px 0;">
                                    <span style="display: block; font-size: 18px; font-weight: 600; color: #333;">{{ $item['producto'] }}</span>
                                    <span style="font-size: 13px; color: #999; text-transform: uppercase;">Color: {{ $item['color'] }}</span>
                                </td>
                                <td style="padding: 20px 0; text-align: center; font-size: 18px; color: #666;">
                                    {{ $item['cantidad'] }}
                                </td>
                                <td style="padding: 20px 0; text-align: right; font-size: 18px; font-weight: 600; color: #333;">
                                    ${{ number_format($item['precio'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="padding-top: 2rem; font-size: 20px; font-weight: 700; color: var(--color-dark-moss);">Total Pagado</td>
                            <td style="padding-top: 2rem; text-align: right; font-size: 28px; font-weight: 700; color: var(--color-clay-brown);">${{ number_format($pedido['total'], 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif

        <div style="display: flex; gap: 2rem; justify-content: center;">
            <a href="{{ route('cliente.pedidos') }}" class="btn btn-primary" style="width: auto; padding: 15px 40px; font-size: 14px;">Ver Mis Pedidos</a>
            <a href="/catalogo" style="padding: 15px 40px; font-size: 14px; text-decoration: none; color: var(--color-dark-moss); font-weight: 700; border: 1px solid var(--color-dark-moss); text-transform: uppercase; letter-spacing: 1px;">Seguir Comprando</a>
        </div>

    </div>
</div>

@endsection