<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700" rel="stylesheet"
          type="text/css">
    <style type="text/css">
        @media print {
            h1 {
                page-break-before: right
            }

            h2 {
                page-break-after: avoid
            }

            table {
                page-break-inside: avoid
            }

            td {
                padding: 5px;
            }

            body {
                font-family: Roboto, SansSerif, Tahoma;
            }


            .no-print {
                margin: 5px;
                font-size: 15px;
            }

            .box {
                width: 100%;
                font-size: 90% !important;
                /*border-bottom: 1px dashed #ccc5b9;*/
                height: 8cm;
                box-sizing: border-box;
                padding-top: 20px;
                padding-bottom: 15px;
            }

            /** Setting margins */
            @page {
                margin: 2cm;
                size: 140mm 330mm;
            }

            /* Or: */
            @page :left {
                margin: 2cm;
            }

            @page :right {
                margin: 2cm;
            }

            .no-print {
                display: none;
            }

            footer {
                page-break-after: always;
            }

            /*.box:first-child {*/
            /*    padding-top: 0;*/
            /*}*/
            /*.box:last-child {*/
            /*    padding-top: 25px;*/
            /*}*/
        }
    </style>
</head>
<body>
<page size="140mm 85mm">
    <div
        class="box">
        <table width="100%">
            <tr>
                <td colspan="2" style="text-align: center">
                    <strong>CENTRAL HERBARIUM OF IRAN</strong>
                </td>
            </tr>
            <tr>
                <td width="50%"><b>No.</b> {{ $herbarium->herbarium_number ?? null }}</td>
                <td width="50%"><b>Fam.</b> {{ $herbarium->taxonomy->family->name ?? null }}</td>
            </tr>
            <tr>
                <td colspan="2"><b>Name.</b> {{ $herbarium->taxonomy->scientific_name ?? null }} {{ $herbarium->taxonomy->authors ?? null }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Prov.</b> {{ !empty($herbarium->location) ? $herbarium->location->address_en : '-' }}
                </td>
            </tr>

            <tr>
                <td><b>N.</b> {{
              !empty($herbarium->location->point) ?
                $herbarium->location->point['DMS'][0] : '-'
            }}
                </td>
                <td><b>Date.</b>
                    {{ $herbarium->collection_date }}
                </td>
            </tr>

            <tr>
                <td><b>E.</b> {{
              !empty($herbarium->location->point) ?
                $herbarium->location->point['DMS'][1] : '-'
            }}
                </td>
                <td><b>Alt.</b> {{ !empty($herbarium->location) ? $herbarium->location->min_altitude : null }}{{
             !empty($herbarium->location) && $herbarium->location['max_altitude'] != '' ? ' - ' . $herbarium->location['max_altitude'] : ''
            }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Notes.</b> {{ $herbarium->description ?? '-' }}
                </td>
            </tr>
            <tr>
                <td><b>Leg.</b>
                    {{ $herbarium->collector ?? '-' }}
                </td>
                <td><b>Det.</b>
                    {{ $herbarium->determiner ?? '-' }}
                </td>
            </tr>
        </table>
    </div>
</page>
</body>
</html>

