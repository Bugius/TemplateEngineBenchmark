{* Smarty. indexFull.tpl*}
<html>
<head>
    <title>{$title}</title>
</head>
<body>
<h2>An example with {$title|capitalize}</h2>
<b>Table with {$number|escape} rows</b>
<table>
    {foreach $table as $row}
        <tr bgcolor="{cycle values="#aaaaaa,#ffffff"}">
            <td>{$row.id}</td>
            <td>{$row.name}</td>
        </tr>
        {foreachelse}
        <tr><td>No items were found</td></tr>
    {/foreach}
</table>
</body>
</html>