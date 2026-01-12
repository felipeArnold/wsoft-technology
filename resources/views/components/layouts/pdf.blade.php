@props(['title' => 'Documento', 'styles' => null])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1f2937;
            line-height: 1.4;
        }

        .container {
            padding: 20px;
        }

        /* Seções */
        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #f3f4f6;
            color: #1f2937;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 12px;
            border-left: 4px solid #4b5563;
            margin-bottom: 10px;
        }

        /* Tabelas de informações */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
        }

        .info-table .label {
            background-color: #f9fafb;
            font-weight: bold;
            width: 30%;
            color: #374151;
        }

        .info-table .value {
            background-color: white;
        }

        /* Grid de 2 colunas */
        .grid-2 {
            width: 100%;
            margin-bottom: 15px;
        }

        .grid-2 td {
            width: 50%;
            vertical-align: top;
            padding: 5px;
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-draft {
            background-color: #e5e7eb;
            color: #374151;
        }

        .status-in_progress {
            background-color: #fef3c7;
            color: #b45309;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Prioridade badge */
        .priority-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
        }

        .priority-low {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .priority-medium {
            background-color: #e5e7eb;
            color: #4b5563;
        }

        .priority-high {
            background-color: #fed7aa;
            color: #ea580c;
        }

        .priority-urgent {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Área de descrição */
        .description-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 5px;
            min-height: 80px;
        }

        /* Valores */
        .values-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .values-table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
        }

        .values-table .total-row {
            background-color: #374151;
            color: white;
            font-weight: bold;
            font-size: 13px;
        }

        .values-table .label-cell {
            text-align: right;
            font-weight: bold;
            background-color: #f9fafb;
        }

        .values-table .value-cell {
            text-align: right;
            width: 30%;
        }

        /* Assinaturas */
        .signatures {
            margin-top: 40px;
            width: 100%;
        }

        .signature-box {
            width: 48%;
            display: inline-block;
            text-align: center;
            padding: 10px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 10px;
        }

        /* Helpers */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        /* Alert boxes */
        .alert-warning {
            background-color: #fef3c7;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #fbbf24;
            margin-top: 10px;
        }

        .alert-info {
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #6b7280;
            margin-top: 10px;
        }

        .alert-success {
            background-color: #d1fae5;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #10b981;
            margin-top: 10px;
        }

        .alert-danger {
            background-color: #fee2e2;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #ef4444;
            margin-top: 10px;
        }

        {{ $styles ?? '' }}
    </style>
</head>
<body>
    <div class="container">
        {{ $slot }}
    </div>
</body>
</html>
