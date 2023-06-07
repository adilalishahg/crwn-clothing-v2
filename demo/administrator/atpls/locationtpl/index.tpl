{ include file = headerinner.tpl}
<table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr><td>{$header}</td></tr>
<tr><td> <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>] </div></td></tr>
<tr><td>{$q}</td></tr>
{section name=q loop=$result}
{if $result[q].votes eq 0}
{assign var='perc' value='0'}
{else}
{math equation = "b * 100 / a" b=$result[q].votes a=$totalvotes assign="perc"}


{/if}



 <tr><td>{$result[q].field}<strong> {$result[q].votes} </strong></td></tr>
 <tr><td><div style="background-color:{$bg1};"><div style="color:{$text_col}; font-size:{$text_size}px; background-color:{$bg2}; width:{$perc}%; text-align:right;">{$perc|floor}%</div></div></td></tr>
{/section}

<tr><td>Total votes: <strong>{$totalvotes}</strong></td></tr>
</table>		 
{ include file = innerfooter.tpl}
