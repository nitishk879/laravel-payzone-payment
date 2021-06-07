<table class='payzone-debug' style='text-align:left;'>
    <tr>
        <th>Debug Mode Active</th>
        <td><?= $PayzoneDebug::BoolToString($PayzoneHelper::getDebugMode()) ?></td>
    </tr>
    <tr>
        <th>Custom Logs</th>
        <td><?= $PayzoneDebug::getCustomErrors() ?></td>
    </tr>
    <tr>
        <th colspan="2"><?= $PayzoneDebug::getCustomLogs() ?></th>
    </tr>
</table>
