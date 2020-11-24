<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700" rel="stylesheet"
          type="text/css">
    <style type="text/css">
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
            height: 8.15cm;
            box-sizing: border-box;
            padding-top: 15px
        }

        .box:nth-child(even){
            padding-top: 25px;
        }


        @page {
            margin: 1cm;
        }

        @media print {
            .no-print {
                display: none;
            }
            footer {page-break-after: always;}

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
@foreach ($herbariums->chunk(4) as $chunk)
    <page size="140mm 330mm">
        @foreach($chunk as $herbarium)
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
                        <td colspan="2"><b>Name.</b> {{ $herbarium->taxonomy->scientific_name ?? null }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Prov.</b> {{ !empty($herbarium->location) ? $herbarium->location->address_en : null }}
                        </td>
                    </tr>

                    <tr>
                        <td><b>N.</b> {{
              !empty($herbarium->location->point) ?
                $herbarium->location->point['DMS'][0] : null
            }}
                        </td>
                        <td><b>Date.</b>
                            {{ $herbarium->collection_date }}
                        </td>
                    </tr>

                    <tr>
                        <td><b>E.</b> {{
              !empty($herbarium->location->point) ?
                $herbarium->location->point['DMS'][1] : null
            }}
                        </td>
                        <td><b>Alt.</b> {{ !empty($herbarium->location) ? $herbarium->location->min_altitude : null }}{{
             !empty($herbarium->location) && $herbarium->location['max_altitude'] != '' ? ' - ' . $herbarium->location['max_altitude'] : ''
            }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Notes.</b> {{ $herbarium->description }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Leg.</b>
                            {{ $herbarium->collector ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Det.</b>
                            {{ $herbarium->determiner ?? null }}
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
        <footer>&nbsp;k</footer>
    </page>
@endforeach
</body>
</html>

