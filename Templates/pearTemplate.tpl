<html>
<head>
    <title>{$title}</title>
</head>
<body>
<h2>An example with {TITLE}</h2>
<b>Table with {NUMBER} rows</b>
<table>
    <!-- BEGIN row -->
        <tr bgcolor="{cycle values="#aaaaaa,#ffffff"}">
            <!-- BEGIN cell -->
            <td>{ENTRY}</td>
            <!-- END cell -->
        </tr>

    <!-- END row -->
</table>
</body>
</html>