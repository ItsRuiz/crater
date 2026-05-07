<!DOCTYPE html>
<html>
<head>
    <title>@lang('pdf_invoice_label') - {{ $invoice->invoice_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        /* Forzamos que el PDF no tenga márgenes para controlarlos nosotros */
        @page { size: a4 landscape; margin: 0; }
        
        body { 
            font-family: "DejaVu Sans"; 
            margin: 0; 
            padding: 0; 
            color: #333; 
            font-size: 7.5px; /* Bajamos un punto para que todo quepa cómodo */
        }
        
        /* Tabla contenedora principal */
        .split-layout { 
            width: 100%; 
            height: 100%;
            border-collapse: collapse; 
            table-layout: fixed; 
        }
        
        /* AQUÍ ESTÁ EL TRUCO: Encogemos cada mitad al 47% y dejamos 6% de espacio muerto */
        .half-side { 
            width: 47%; 
            padding: 25px 15px; /* Margen superior e inferior generoso */
            vertical-align: top; 
            box-sizing: border-box;
        }

        /* Columna invisible para crear el margen derecho de la hoja */
        .spacer { width: 6%; }
        
        /* Línea de corte */
        .cut-line { border-left: 1px dashed #bbb; }

        table.inner-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        
        .header-logo { max-height: 30px; margin-bottom: 5px; }
        .company-name { font-size: 10px; font-weight: bold; color: #5851DB; }
        .company-data { font-size: 7px; line-height: 9px; color: #555; }
        
        .invoice-title { font-size: 11px; font-weight: bold; margin-bottom: 5px; }

        /* Espaciado para que no se amontone el número y la fecha */
        .invoice-meta { width: 100%; }
        .invoice-meta td { padding: 1px 0; font-size: 7px; white-space: nowrap; }
        .meta-label { width: 60%; font-weight: bold; }
        .meta-value { width: 40%; text-align: right; }

        .info-box { 
            margin-top: 5px; 
            border: 1px solid #eee; 
            background: #fdfdfd; 
            padding: 5px; 
        }
        .info-box b { color: #5851DB; font-size: 8px; display: block; }

        .table-wrapper { margin-top: 10px; }
        .table-wrapper table { width: 100% !important; table-layout: fixed !important; }
        .table-wrapper table th, 
        .table-wrapper table td { padding: 2px !important; font-size: 7px !important; }

        .payment-box {
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #eee;
            background: #fdfdfd;
            font-size: 7px;
        }
    </style>
</head>
<body>

    <table class="split-layout">
        <tr>
            <td class="half-side">
                <table class="inner-table">
                    <tr>
                        <td width="55%">
                            <div class="company-name">Antara Grocery Seijas, F.P</div>
                            <div class="company-data">
                                R.I.F: V-103088719<br>
                                El Tigre, Estado Anzoátegui<br>
                                +58 424 8516300
                            </div>
                        </td>
                        <td width="45%">
                            <div class="invoice-title" style="color: #5851DB; text-align: right;">ORIGINAL</div>
                            <table class="invoice-meta">
                                <tr><td class="meta-label">Factura:</td><td class="meta-value">{{ $invoice->invoice_number }}</td></tr>
                                <tr><td class="meta-label">Fecha:</td><td class="meta-value">{{ $invoice->formattedInvoiceDate }}</td></tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div class="info-box">
                    <b>@lang('pdf_bill_to'):</b>
                    {!! $billing_address !!}
                </div>

                <div class="table-wrapper">
                    @include('app.pdf.invoice.partials.table')
                </div>

                <div class="payment-box">
                    <b>Pago:</b> V-10308871 | Pago Móvil: 0424-8516300 | Zelle: Jochseijas@gmail.com
                </div>
            </td>

            <td class="cut-line spacer"></td>

            <td class="half-side">
                <table class="inner-table">
                    <tr>
                        <td width="55%">
                            <div class="company-name">Antara Grocery Seijas, F.P</div>
                            <div class="company-data">
                                R.I.F: V-103088719<br>
                                El Tigre, Estado Anzoátegui
                            </div>
                        </td>
                        <td width="45%">
                            <div class="invoice-title" style="color: #7f8c8d; text-align: right;">COPIA</div>
                            <table class="invoice-meta">
                                <tr><td class="meta-label">Factura:</td><td class="meta-value">{{ $invoice->invoice_number }}</td></tr>
                                <tr><td class="meta-label">Fecha:</td><td class="meta-value">{{ $invoice->formattedInvoiceDate }}</td></tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div class="info-box">
                    <b>@lang('pdf_bill_to'):</b>
                    {!! $billing_address !!}
                </div>

                <div class="table-wrapper">
                    @include('app.pdf.invoice.partials.table')
                </div>

                <div class="payment-box">
                    <b>Pago:</b> V-10308871 | Pago Móvil: 0424-8516300
                </div>
            </td>
        </tr>
    </table>

</body>
</html>