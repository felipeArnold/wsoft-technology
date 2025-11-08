@props(['leftLabel', 'leftName', 'rightLabel', 'rightName'])

<div class="signatures">
    <table style="width: 100%;">
        <tr>
            <td class="signature-box">
                <div class="signature-line">
                    {{ $leftName }}<br>
                    <small>{{ strtoupper($leftLabel) }}</small>
                </div>
            </td>
            <td style="width: 4%;"></td>
            <td class="signature-box">
                <div class="signature-line">
                    {{ $rightName }}<br>
                    <small>{{ strtoupper($rightLabel) }}</small>
                </div>
            </td>
        </tr>
    </table>
</div>
