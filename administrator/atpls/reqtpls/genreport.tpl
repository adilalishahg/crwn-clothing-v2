{*include file = headerinner.tpl*}



 {literal}







 <style type="text/css">

 .bg_col {  background-color:#ffe5d8; !important;

 background-image: none !important;

}
    #printable { display: block; }


    @media print



    {

        #non-printable { display: none; }

        #printable { display: block; }

    }

table { font-family:"Arial"}

table td { font-size:7px; color:#fb070e;}

table td b { font-size:8px; font-weight:bold; padding-left:3px; color:#fb070e;}

.sub_tab table td {}

    </style>



{/literal}



<div align="left">



<div align="right" id="non-printable" style="width:612px; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a> </div>
<div align="center" id="printable">
<table background="" width="100%"  border="0" cellspacing="0" cellpadding="0">

<tr></tr>

<tr>

  <td colspan="4" valign="bottom" style="height:85px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

      <td width="37%" align="left" ><table style="border:#333 1px solid; color:#333;"  border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td height="15" width="50" align="center" valign="middle" style="font-size:14px; font-weight:bold; color:#333;">1500</td>

  </tr>

</table>

</td>

      <td width="100%" rowspan="3" align="left" style="padding-right:0px;"><table><tr style="width:100%"><td align="left" style="width:350px;"><b><font size="2px" color="#000000">{$hicdata.0.deptstamp|upper}</font></b></td><td align="right" style="width:250px"><b><font size="2px" color="#000000">&nbsp;{if $showreclaim eq '1'}<a rel="facebox" href="getclaim.php?id={$id}" style="text-decoration:none;" id="non-printable">

					Reclaim

                    </a>{/if}&nbsp;{if $reclaimid1 neq '' && $reclaimid2 neq ''}{$hicdata.0.resubmission}{/if} </font></b></td></tr></table></td>

    </tr>

    <tr>

      <td style="font-size:14px; font-weight:bold;">HEALTH INSURANCE CLAIM FORM</td>

      </tr>	  

    <tr>

      <td height="15">APPROVED BY NATIONAL UNIFORM CLAIM COMMITTEE 08/05 </td>

      </tr>

    <tr>

      <td colspan="2" style="padding-left:4px;"><table width="100%"  height="15" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="2%" style="border:#fb070e 1px solid;">&nbsp;</td>

          <td width="2%" style="border:#fb070e 1px solid;">&nbsp;</td>

          <td width="2%" style="border:#fb070e 1px solid;" >&nbsp;</td>

          <td width="44%">PICA</td>

          <td width="44%" align="right">PICA</td>

          <td width="2%" style="border:#fb070e 1px solid;">&nbsp;</td>

          <td width="2%" style="border:#fb070e 1px solid;">&nbsp;</td>

          <td width="2%" style="border:#fb070e 1px solid;">&nbsp;</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td width="18"><img src="../images/career.jpg" width="12" height="85"  /></td>

</tr>

<tr>

  <td width="7" >&nbsp;</td>

  <td colspan="2" style="height:32px; border-top:#fb070e 2px solid; border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="476"   border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10"   align="left" valign="top">1.</td>

      <td valign="middle" >MEDICARE </td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >MEDICAID </td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >TRICARE CHAMPUS</td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >CHAMPVA </td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >GROUP HEALTH PLAN</td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >FECA BLK LUNG</td>

      <td valign="middle">&nbsp;</td>

      <td valign="middle" >OTHER</td>

    </tr>

    <tr>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(Medicare #)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(Medicaid #)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(Sponsors SSN)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(member ID #)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(SSN or ID)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(SSN)</td>

      <td valign="bottom"><input type="checkbox" disabled="disabled" /></td>

      <td >(ID)</td>

    </tr>

  </table></td>

  <td width="296" valign="top" style="border-top:#fb070e 2px solid; border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">1a. ISURED'S I.D. NUMBER </td>

      <td width="95" valign="middle">(FOR PROGRAM IN ITEM 1)</td>

    </tr>

    <tr>

      <td colspan="2"><b><font size="2px" color="#000000">{$cisid}</font></b></td>

    </tr>

  </table></td>

  <td rowspan="11"><img src="../images/pat.jpg" width="12" height="370"  /></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td width="281" style="height:31px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">2. corporates NAME (Last Name, First, Middle Initial)</td>

    </tr>

    <tr>

      <td><b><font size="2px" color="#000000">{$pname}</font></b></td>

    </tr>

  </table></td>

  <td width="198" style="border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="100%" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="53%"  valign="top"><table width="103%"  border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td height="10" colspan="3" >3. corporates BIRTH DATE</td>

        </tr>

        <tr>

          <td width="38%"  align="center" valign="top" >MM</td>

          <td width="32%"  align="center" valign="top" >DD</td>

          <td width="30%"  align="center" valign="top" >YY</td>

          </tr>

           <tr>

          <td width="38%"  align="center" valign="top" ><b><font color="#000000" size="1px">{$m}</font></b></td>

          <td width="32%"  align="center" valign="top" ><b><font color="#000000" size="1px">{$d}</font></b></td>

          <td width="30%"  align="center" valign="top" ><b><font color="#000000" size="1px">{$y}</font></b></td>

          </tr>

        <tr>

          <td colspan="3"  align="center" valign="top" ></td>

          </tr>

      </table></td>

      <td width="47%" valign="top"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="13%" >&nbsp;</td>

          <td width="18%">&nbsp;</td>

          <td width="23%">SEX</td>

          <td width="9%">&nbsp;</td>

          <td width="15%">&nbsp;</td>

          <td width="22%">&nbsp;</td>

        </tr>

        <tr>

          <td align="right" valign="middle">M</td>

          <td valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td valign="middle">&nbsp;</td>

          <td align="right" valign="middle">F</td>

          <td valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td>&nbsp;</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">4. INSUREDS NAME (Last Name, First Name, Middle Initial)</td>

      <td width="95" valign="middle"></td>

    </tr>

    <tr>

      <td colspan="2"><b><font size="2px" color="#000000">{$pname}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:32px;  border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">5. corporates ADDRESS (No, Street)</td>

    </tr>

    <tr>

      <td><b><font color="#000000" size="2px">{$pck}</font></b></td>

    </tr>

  </table></td>

  <td width="198" style="border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="198" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">6. Corporate RELATIONSHIP TO INSURED</td>

    </tr>

    <tr>

      <td><table width="100%" height="20" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="16%" height="14" align="right">Self</td>

          <td width="9%"><input type="checkbox"  checked="checked" /></td>

          <td width="17%" align="right">Spouse</td>

          <td width="8%"><input type="checkbox" disabled="disabled" /></td>

          <td width="12%" align="right">Child</td>

          <td width="9%"><input type="checkbox" disabled="disabled" /></td>

          <td width="16%" align="right">Other</td>

          <td width="13%"><input type="checkbox" disabled="disabled" /></td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">7. INSUREDS ADDRESS (No, Street)</td>

      <td width="95" valign="middle"></td>

    </tr>

    <tr>

      <td colspan="2"><b><font color="#000000" size="2px">{$pck}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:31px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="244"  height="10" align="left" style="border-right:#fb070e 1px solid;">CITY</td>

      <td width="37"  align="left">STATE</td>

    </tr>

    <tr>

      <td style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="2px">{$pckcity}</font></b></td>

      <td><b><font color="#000000" size="2px">{$pckstate}</font></b></td>

    </tr>

  </table></td>

  <td width="198" rowspan="2" valign="top" style="border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="198" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">8. Corporate STATUS</td>

    </tr>

    <tr>

      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="25%" align="right">Single</td>

          <td width="8%"><input type="checkbox" checked="checked"  /></td>

          <td width="22%" align="center">Married</td>

          <td width="8%"><input type="checkbox" disabled="disabled" /></td>

          <td width="23%" align="center">Other</td>

          <td width="14%"><input type="checkbox" disabled="disabled" /></td>

        </tr>

      </table></td>

    </tr>

    <tr>

      <td><table width="100%" height="34" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td height="12" colspan="6">&nbsp;</td>

        </tr>

        <tr>

          <td width="25%" align="right">Employed</td>

          <td width="8%"><input type="checkbox" disabled="disabled" /></td>

          <td width="22%" align="center">Full-Time Student</td>

          <td width="8%"><input type="checkbox" disabled="disabled" /></td>

          <td width="23%" align="center">Part-Time Student</td>

          <td width="14%"><input type="checkbox" disabled="disabled" /></td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="231" height="10" align="left" style="border-right:#fb070e 1px solid;">CITY</td>

      <td width="65" align="left">STATE</td>

    </tr>

    <tr>

      <td style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="2px">{$pckcity}</font></b></td>

      <td><b><font color="#000000" size="2px">{$pckstate}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:33px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table  height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="127"  height="10" align="left" style="border-right:#fb070e 1px solid;">ZIP CODE</td>

      <td width="153" align="left">TELEPHONE (INCLUDE AREA CODE)</td>

    </tr>

    <tr>

      <td style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="2px">{$pckzip}</font></b></td>

      <td><b><font color="#000000" size="2px">{$phnum}</font></b></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="125" height="10" align="left" style="border-right:#fb070e 1px solid;">ZIP CODE</td>

      <td width="171" align="left">TELEPHONE (Include Area Code)</td>

    </tr>

    <tr>

      <td style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="2px">{$pckzip}</font></b></td>

      <td><b><font color="#000000" size="2px">{$phnum}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:31px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">9. OTHER INSUREDS NAME (Last Name,First Nme Middle Initial)</td>

    </tr>

    <tr>

      <td></td>

    </tr>

  </table></td>

  <td width="198" rowspan="4" valign="top" style="border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="198" height="35" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">10. IS corporates CONDITION RELATED TO:</td>

    </tr>

    <tr>

      <td height="25">&nbsp;</td>

    </tr>

  </table>

    <table width="198" height="31" border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td height="10" valign="middle">a. EMPLOYMENT? (Current or Prevoius)</td>

      </tr>

      <tr>

        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

          <tr>

            <td width="25%" align="right">Yes</td>

            <td width="8%"><input type="checkbox" {if $hicdata.0.condemp eq '1'} checked="checked" {else} disabled="disabled" {/if} /></td>

            <td width="22%" align="center">&nbsp;</td>

            <td width="8%"><input type="checkbox" {if $hicdata.0.condemp eq '0'} checked="checked"  {else} disabled="disabled" {/if} /></td>

            <td width="23%" align="left">No</td>

            <td width="14%">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

    </table>

    <table width="198" height="31" border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td height="10" valign="middle">b. AUTO ACCIDENT?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PLACE (State)</td>

      </tr>

      <tr>

        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

          <tr>

            <td width="25%" align="right">Yes</td>

            <td width="8%"><input type="checkbox" {if $hicdata.0.condauto eq '1'} checked="checked" {else} disabled="disabled" {/if} /></td>

            <td width="22%" align="center">&nbsp;</td>

            <td width="8%"><input type="checkbox"  {if $hicdata.0.condauto eq '0'} checked="checked" {else} disabled="disabled" {/if} /></td>

            <td width="23%" align="left">No</td>

            <td width="14%">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

    </table>

    <table width="198" height="31" border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td height="10" valign="middle">c. OTHER ACCIDENT?</td>

      </tr>

      <tr>

        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

          <tr>

            <td width="25%" align="right">Yes</td>

            <td width="8%"><input type="checkbox" {if $hicdata.0.condother eq '1'} checked="checked" {else} disabled="disabled" {/if} /></td>

            <td width="22%" align="center">&nbsp;</td>

            <td width="8%"><input type="checkbox" {if $hicdata.0.condother eq '0'} checked="checked" {else} disabled="disabled" {/if} /></td>

            <td width="23%" align="left">No</td>

            <td width="14%">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">11. INSUREDS POLICY FROUP OR FECA NUMBER</td>

      <td width="95" valign="middle"></td>

    </tr>

    <tr>

      <td colspan="2"></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:31px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">a. OTHER INSUREDS POLICY OR GROUP NUMBER</td>

    </tr>

    <tr>

      <td></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296"  border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="156" valign="top" ><table width="80%"border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td colspan="3" >a. INSUREDS DATE OF BIRTH</td>

        </tr>

        <tr>

          <td height="11" align="right" valign="top">MM</td>

          <td align="center" valign="top">DD</td>

          <td align="left" valign="top">YY</td>

        </tr>

        <tr>

          <td height="11" align="right" valign="top"><b><font color="#000000" size="1px">{$m}</font></b></td>

          <td align="center" valign="top"><b><font color="#000000" size="1px">{$d}</font></b></td>

          <td align="left" valign="top"><b><font color="#000000" size="1px">{$y}</font></b></td>

        </tr>

      </table></td>

      <td width="140" valign="top" ><table width="100%"  border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="13%" height="13">&nbsp;</td>

          <td width="14%">&nbsp;</td>

          <td width="29%">SEX</td>

          <td width="9%">&nbsp;</td>

          <td width="14%">&nbsp;</td>

          <td width="21%">&nbsp;</td>

        </tr>

        <tr>

          <td align="right" valign="middle">M</td>

          <td><input type="checkbox" disabled="disabled" /></td>

          <td>&nbsp;</td>

          <td align="right" valign="middle">F</td>

          <td><input type="checkbox" disabled="disabled" /></td>

          <td>&nbsp;</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:33px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281"  border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="134" valign="top" ><table width="86%"border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td colspan="3" >b. OTHER INSUREDS DATE OF BIRTH</td>

        </tr>

        <tr>

          <td height="11" align="right" valign="top">MM</td>

          <td align="center" valign="top">DD</td>

          <td align="left" valign="top">YY</td>

        </tr>

        <tr>

          <td colspan="3"  align="center" valign="top"><b></b></td>

        </tr>

      </table></td>

      <td width="147" valign="top" ><table width="144"   border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="31"  height="13">&nbsp;</td>

          <td width="29" >&nbsp;</td>

          <td width="15" >SEX</td>

          <td width="16" >&nbsp;</td>

          <td width="21" >&nbsp;</td>

          <td width="32" >&nbsp;</td>

        </tr>

        <tr>

          <td align="right" valign="middle">M</td>

          <td><input type="checkbox" disabled="disabled" /></td>

          <td>&nbsp;</td>

          <td align="right" valign="middle">F</td>

          <td><input type="checkbox" disabled="disabled" /></td>

          <td>&nbsp;</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">b. EMPLOYERS NAME OR SCHOOL NAME </td>

      <td width="95" valign="middle"></td>

    </tr>

    <tr>

      <td colspan="2"></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:32px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">c. EMPLOYERS NAME OR SCHOOL NAME</td>

    </tr>

    <tr>

      <td>&nbsp;</td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">c. INSURANCE PLAN NAME OR PROGRAM NAME</td>

      <td width="95" valign="middle"></td>

    </tr>    

   <tr>

      <td width="201" valign="middle"><span style="font-size:11px;"><font color="#000000"  >{$hicdata.0.program|upper}</font></span></td>

      <td width="95" valign="middle"></td>

    </tr>  

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:32px; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">d. INSURANCE PLAN NAME OR PROGRAM NAME</td>

    </tr>

    <tr>

      <td><b><font color="#000000" size="2px">{$hicdata.0.program|upper}</font></b></td>

    </tr>

  </table></td>

  <td width="198" style="border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;" valign="top"><table width="198"  border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">10d. RESERVED FOR LOCAL USE</td>

    </tr>

    <tr>

      <td height="13">&nbsp;</td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">d. IS THERE ANOTHER HEALTH BENEFIT PLAN?</td>

      <td width="95" valign="middle"></td>

    </tr>

    <tr>

      <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="11%" height="15" align="right" valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td width="8%">YES</td>

          <td width="11%" align="right" valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td width="10%">NO</td>

          <td width="60%">If yes, return to and complete item 9 a-d.</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="2" style="height:42px; border-right:#fb070e 2px solid; border-left:#fb070e 1px solid; "><table width="100%" height="41" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td colspan="2"  valign="top"><div style="width:100%; text-align:center">READ BACK OF FORM BEFORE COMPLETING & SIGNING THIS FORM.</div>

        12. corporates OR AUTHORISED PERSONS SIGNATURE I authrize the release of any medical or other information necessary to process this claim. <br />

        I also

        request payment of government benefits either to myself or to the party who accepts assignment </td>

    </tr>

    <tr>

      <td width="66%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGNED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color="#000000" size="1px" style="text-decoration:underline" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGNATURE  ON FILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>

      <td width="34%" >DATE &nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:11px;"><font color="#000000"  > {$appm}-{$appd}-{$app2y}</font></span></td>

    </tr>

  </table></td>

  <td valign="top" style="border-right:#fb070e 1px solid;"><table width="296" height="41" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td  valign="top">13. INSUREDS OR AUTHORIZED PERSONS SIGNATURE <br />

        I authorize 

        payment of medical benefits to the undersigned physician or supplier for <br />

        services described below.</td>

    </tr>

    <tr>

      <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGNED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color="#000000" size="1px" style="text-decoration:underline" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGNATURE  ON FILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td style="height:30px; border-top:#fb070e 3px solid; border-right:#fb070e 1px solid; border-left:#fb070e 1px solid; border-bottom:#fb070e 1px solid;"><table width="281"  border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="124" valign="top" ><table width="86%"border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td colspan="3" >14. DATE OF CURRENT:</td>

        </tr>

        <tr>

          <td height="11" align="right" valign="top">MM</td>

          <td align="center" valign="top">DD</td>

          <td align="left" valign="top">YY</td>

        </tr>

       <tr>

          <td height="11" align="right" valign="top"></td>

          <td align="center" valign="top"></td>

          <td align="left" valign="top"></td>

        </tr>

      </table></td>

      <td width="157" valign="top" ><table width="155" height="28"  border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="27" align="right" valign="top" ><img src="../images/b_arrow.jpg" width="11" height="24"  /></td>

          <td width="128"  valign="top" >ILLNESS (First symptom) OR<br />

            INJURY (Accident) OR<br />

            PREGNANCY (LMP)</td>

        </tr>

      </table></td>

    </tr>

  </table></td>

  <td width="198" valign="top" style="border-top:#fb070e 3px solid; border-right:#fb070e 2px solid;  border-bottom:#fb070e 1px solid;"><table width="100%"border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="11" colspan="4" >15. IF Corporate HAS HAD SAME OR SIMILAR ILLNESS.</td>

    </tr>

    <tr>

      <td width="33%" height="7" align="right" valign="top">GIVE FIRST DATE</td>

      <td width="23%" height="7" align="right" valign="top">MM</td>

      <td width="9%" align="center" valign="top">DD</td>

      <td width="35%" align="left" valign="top">YY</td>

    </tr>

    <tr>

      <td colspan="4"  align="center" valign="top"></td>

    </tr>

  </table></td>

  <td valign="top" style="border-top:#fb070e 3px solid; border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" colspan="11">16. DATES Corporate UNABLE TO WORK IN CURRENT OCCUPATION </td>

    </tr>

    <tr>

      <td width="6%" height="20">&nbsp;</td>

      <td width="10%">FROM</td>

      <td width="7%" align="center" valign="top">MM</td>

      <td width="12%" align="center" valign="top">DD</td>

      <td width="9%" align="center" valign="top">YY</td>

      <td width="11%">&nbsp;</td>

      <td width="6%">TO</td>

      <td width="7%" align="center" valign="top">MM</td>

      <td width="12%" align="center" valign="top">DD</td>

      <td width="9%" align="center" valign="top">YY</td>

      <td width="11%">&nbsp;</td>

    </tr>

  </table></td>

  <td rowspan="8"><img src="../images/phy.jpg" width="12" height="420"  /></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td valign="top" style=" height:32px; border-left:#fb070e 1px solid; border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" valign="middle">17. NAME OF REFFERING PROVIDERS OR OTHER SOURCE</td>

    </tr>

    <tr>

      <td></td>

    </tr>

  </table></td>

  <td width="198" valign="top" style=" border-right:#fb070e 2px solid;  border-bottom:#fb070e 1px solid;"><table width="198" height="32" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="25" height="10" valign="middle" style="border-right:#fb070e 1px solid;">17a. </td>

      <td width="19" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

      <td width="154" valign="middle">&nbsp;</td>

    </tr>

    <tr>

      <td width="25" height="10" valign="middle" style="border-right:#fb070e 1px solid;">17b. </td>

      <td width="19" align="center" valign="middle" style="border-right:#fb070e 1px solid;">NPI</td>

      <td width="154" valign="middle">&nbsp;</td>

    </tr>

  </table></td>

  <td valign="top" style=" border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" colspan="11">18. CorporateIZATION DATES RELATED TO CURRENT SERVICES</td>

    </tr>

    <tr>

      <td width="6%" height="20">&nbsp;</td>

      <td width="10%">FROM</td>

      <td width="7%" align="center" valign="top">MM</td>

      <td width="12%" align="center" valign="top">DD</td>

      <td width="9%" align="center" valign="top">YY</td>

      <td width="11%">&nbsp;</td>

      <td width="6%">TO</td>

      <td width="7%" align="center" valign="top">MM</td>

      <td width="12%" align="center" valign="top">DD</td>

      <td width="9%" align="center" valign="top">YY</td>

      <td width="11%">&nbsp;</td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="2" valign="top" style=" height:27px; border-left:#fb070e 1px solid; border-right:#fb070e 2px solid;  border-bottom:#fb070e 1px solid;"><table width="281" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="9" valign="middle">19. RESERVED FOR LOCAL USE</td>

    </tr>

   <!-- <tr>

      <td>&nbsp;</td>

    </tr>-->

  </table></td>

  <td valign="top" style=" border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="145" height="9" valign="middle">20. OUTSIDE LAB?</td>

      <td width="151" valign="middle">$ CHARGES</td>

    </tr>

    <tr>

      <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td width="11%" height="11" align="right" valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td width="8%">YES</td>

          <td width="11%" align="right" valign="middle"><input type="checkbox" disabled="disabled" /></td>

          <td width="7%" style="border-right: 1px solid #fb070e;">NO</td>

          <td width="32%" style="border-right: 1px solid #fb070e;"></td>

          <td width="31%"></td>

        </tr>

      </table></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td height="20">&nbsp;</td>

  <td colspan="2" rowspan="2" valign="top" style="border-left:#fb070e 1px solid; border-right:#fb070e 2px solid;   "><table width="100%" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td colspan="2" valign="top">21. DIAGNOSIS OR NATURE OF ILLNESS OR INJURY. (RELATE ITEMS 1.2.3 OR 4 TO ITEM 24E BY LINE</td>

      <td width="19%" rowspan="2" align="center" valign="middle"><img src="../images/down_arrow.jpg" width="39" height="20"  /></td>

    </tr>

    <tr>

      <td width="57%" height="24">1. &nbsp;&nbsp;&nbsp;<b style="text-decoration:underline"><font color="#000000" size="2px">{$hicdata.0.diagnosis}</font></b></td>

      <td width="24%">3._______________&nbsp;&nbsp;&nbsp;</td>

      </tr>

    <tr>

      <td height="18">2._______________</td>

      <td colspan="2">4._______________</td>

    </tr>

  </table></td>

  <td valign="top" style=" height:9px; border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>

      <td colspan="2">22. MEDICAID RESUBMISSION</td>

    </tr>

    <tr>

      <td width="38%" height="18" valign="top">CODE<br /><b><font size="2px" color="#000000">{$reclaimid1}</font></b></td>

      <td width="62%" valign="top">ORIGINAL REF.NO.<br /><b><font size="2px" color="#000000">{$reclaimid2}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td height="19">&nbsp;</td>

  <td valign="top" style=" border-right:#fb070e 1px solid;  "><table width="296" height="31" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td width="201" height="10" valign="middle">23. PRIOR AUTHORIZATION NUMBER</td>

      <td width="95" valign="middle"></td>

    </tr>

   <!-- <tr>

      <td colspan="2">&nbsp;</td>

    </tr>-->

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="2" valign="top" style="border-bottom: 1px solid #fb070e;"><div class="sub_tab">

    <table width="100%"  border="0" cellpadding="0" cellspacing="0" >

      <tr>

        <td style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid; border-left:#fb070e 1px solid;" colspan="6" >24.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE(S) OF SERVICE</td>

        <td width="6%" style="border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;" align="center">B</td>

        <td width="5%" style="border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;" align="center">C</td>

        <td colspan="5" align="center" style="border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">D</td>

        <td width="12%" align="center" style="border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">E</td>

      </tr>

      <tr>

        <td height="6" colspan="6" style=" border-right:#fb070e 1px solid; border-left:#fb070e 1px solid;"  valign="top" align="center">&nbsp;</td>

        <td rowspan="3" align="center" valign="top" style="border-right:#fb070e 1px solid;" >Place<br />

          of<br />

          Service <br /></td>

        <td rowspan="3" align="center" style=" border-right:#fb070e 1px solid;" valign="top" >EMG</td>

        <td colspan="5" valign="top" style="border-right:#fb070e 1px solid;">PROCEDURES, SERVICES, OR SUPPLIES</td>

        <td  style="height:26px;  border-right:#fb070e 1px solid;" rowspan="3" align="center" valign="middle">DIAGNOSIS<br />

          CODE</td>

      </tr>

      <tr>

        <td height="7" colspan="3" align="center" valign="top" style="border-left:#fb070e 1px solid;" >From</td>

        <td height="7" colspan="3" style=" border-right:#fb070e 1px solid;"" align="center" valign="top" >To</td>

        <td colspan="5" align="center" valign="top" style=" border-right:#fb070e 1px solid;" >(Explain Unusual Circumstances)</td>

      </tr>

      <tr>

        <td  height="9" align="center" valign="top" style="border-left:#fb070e 1px solid;">MM</td>

        <td  height="9" align="center" valign="top" >DD</td>

        <td  height="9" align="center" valign="top" >YY</td>

        <td  height="9" align="center" valign="top" >MM</td>

        <td height="9" align="center" valign="top" >DD</td>

        <td  height="9" style=" border-right:#fb070e 1px solid;"" align="center" valign="top" >YY</td>

        <td align="center" valign="top">CPT/HCPCS</td>

        <td colspan="4" align="center" valign="top" style="border-right:#fb070e 1px solid;" >MODIFIER</td>

      </tr>

      <tr>

        <td colspan="14" bgcolor="#ffbc9a" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  ><b><font color="#000000" size="1px">{$appm}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appd}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" ><b><font color="#000000" size="1px">{$appy}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appm}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appd}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" ><b><font color="#000000" size="1px">{$appy}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$hicdata.0.service1}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$hicdata.0.cpt1}</font></b></td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><span style="font-size:11px;"><font color="#000000"  >1&nbsp;</font></span></td>

      </tr>

      

      <tr>

        <td colspan="14" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  ><b><font color="#000000" size="1px">{$appm}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appd}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" ><b><font color="#000000" size="1px">{$appy}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appm}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" ><b><font color="#000000" size="1px">{$appd}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" ><b><font color="#000000" size="1px">{$appy}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$hicdata.0.service2}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$hicdata.0.cpt2}</font></b></td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><span style="font-size:11px;"><font color="#000000"  >1&nbsp;</font></span></td>

      </tr>

      

      <tr>

        <td colspan="14" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

      </tr>

      

      <tr>

        <td colspan="14" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

      </tr>

      

      <tr>

        <td colspan="14" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

      </tr>

      

      <tr>

        <td colspan="14" class="bg_col" style="height:13px; border-top:#fb070e 1px solid; border-left:#fb070e 1px solid; background-color:#ffe5d8;">&nbsp;</td>

        </tr>

      <tr>

        <td align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed; border-left:#fb070e 1px solid;"  >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px dashed;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;" >&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="13%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td width="6%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="4%" align="center" valign="middle" style="border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="8%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

      </tr>

    </table>

  </div></td>

  <td valign="top" style="border-bottom: 1px solid #fb070e;"><div class="sub_tab">

    <table width="100%"   border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td colspan="2" align="center" valign="middle" style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">F</td>

        <td width="13%" align="center" valign="middle" style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">G</td>

        <td width="9%" align="center" valign="middle" style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">H</td>

        <td width="7%" align="center" valign="middle" style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">I</td>

        <td width="35%" align="center" valign="middle" style="height:12px;  border-top:#fb070e 1px solid;  border-right:#fb070e 1px solid;">J</td>

      </tr>

      <tr>

        <td colspan="2" align="center" valign="middle" style="height:26px;  border-right:#fb070e 1px solid;">S CHARGES</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">DAYS<br />

          OR<br />

          UNITS</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">EPSDT<br />

          Family<br />

          Plan</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">ID<br />

          QUAL</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">RENDERING<br />

          PROVIDERS ID. #</td>

      </tr>

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td align="center" valign="middle" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col"><b><font color="#000000" size="1px">{$hicdata.0.provider}</font></b>&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;"><b><font color="#000000" size="1px">{$dollars}</font></b></td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$cents}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$units_db}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;"><b><font color="#000000" size="1px">1013282433</font></b></td>

      </tr>

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td align="center" valign="middle" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col"><b><font color="#000000" size="1px">{$hicdata.0.provider}</font></b>&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;"><b><font color="#000000" size="1px">{$chgf}</font></b></td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$chgs}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$milage}</font></b></td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;"><b><font color="#000000" size="1px">1013282433</font></b></td>

      </tr>

      

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;"><b><font color="#000000" size="1px"></font></b></td>

      </tr>

      

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;"><b><font color="#000000" size="1px">&nbsp;</font></b></td>

      </tr>

      

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">&nbsp;</td>

      </tr>

      

      

      <tr>

        <td colspan="4" style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        <td style="height:13px; border-top:#fb070e 1px solid; border-right:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">&nbsp;</td>

        </tr>

      <tr>

        <td width="26%" align="center" valign="middle" style="height:14px; border-right:#fb070e 1px dashed;">&nbsp;</td>

        <td width="10%" align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid;">&nbsp;</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">NPI</td>

        <td align="center" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px dashed;">&nbsp;</td>

      </tr>

      

      

      

      

      

      

      

    </table>

  </div></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="2" valign="top" style=" height:29px; border-left:#fb070e 1px solid; border-right:#fb070e 2px solid;  border-bottom:#fb070e 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>

      <td width="33%">25. FEDERAL TAX I.D. NUMBER</td>

      <td width="4%">SSN</td>

      <td width="8%" style="border-right:#fb070e 1px solid;">EIN</td>

      <td width="30%" style="border-right:#fb070e 1px solid;">26. corporates ACCOUNT NO. <br/><b><font color="#000000" size="1px">{$cisid}</font></b></td>

      <td colspan="4" style="font-size:8px;">27. ACCEPT ASSIGNMENT?<br />

      <div style="font-size:7px;">(For govt. claims, see back)</div>

</td>

    </tr>

    <tr>

      <td><b><font color="#000000" size="1px">{$hicdata.0.tax}</font></b></td>

      <td><input type="checkbox" {if $hicdata.0.ssn eq '1'} checked="checked" {else} disabled="disabled" {/if} /></td>

      <td style="border-right:#fb070e 1px solid;"><input type="checkbox" {if $hicdata.0.ein eq '1'} checked="checked" {else} disabled="disabled" {/if} /></td>

      <td style="border-right:#fb070e 1px solid;">&nbsp;</td>

      <td width="5%"><input type="checkbox" disabled="disabled" /></td>

      <td width="5%">YES</td>

      <td width="5%"><input type="checkbox" disabled="disabled" /></td>

      <td width="10%">NO</td>

    </tr>

  </table></td>

  <td valign="top" style="  border-bottom:#fb070e 1px solid; border-right:#fb070e 1px solid; "><table width="100%" height="29" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td height="10" colspan="2" style=" border-right:#fb070e 1px solid;">28. TOTAL CHARGE</td>

      <td colspan="2" style="border-right:#fb070e 1px solid;">29. AMOUNT PAID</td>

      <td colspan="2" >30. BALANCE DUE</td>

    </tr>

    <tr>

      <td width="22%" height="16" style=" border-right:#fb070e 1px dashed;">&nbsp;&nbsp;<b><font color="#000000" size="1px">${$totf}</font></b></td>

      <td width="11%" style=" border-right:#fb070e 1px solid;"><b><font color="#000000" size="1px">{$tots}</font></b></td>

      <td width="26%" style=" border-right:#fb070e 1px dashed;">&nbsp;&nbsp;$</td>

      <td width="12%" style=" border-right:#fb070e 1px solid;">&nbsp;</td>

      <td width="18%" style="border-right:#fb070e 1px dashed;" >&nbsp;&nbsp;$</td>

      <td width="11%" >&nbsp;</td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="2" valign="top" style=" height:65px; border-left:#fb070e 1px solid; border-right:#fb070e 2px solid;  border-bottom:#fb070e 1px solid;"><table width="100%"  cellpadding="0" cellspacing="0">

    <tr>

      <td colspan="2" rowspan="2" valign="top" style="height:50px; border-right:#fb070e 1px solid;">31. SIGNATURE OF PHYSICIAN OR SUPPLIER<br />

        INCLUDING DEGREES OR CREDENTIALS<br />

        (I Certify that the statments on the reverse<br />

        apply to this bill and are made a part thereof.)</td>

      <td colspan="2" valign="top" >32. SERVICE FACILITY LOCATION INFORMATION

        </td>

    </tr>

    <tr>

      <td colspan="2" valign="top" align="center"><strong><font color="#000000" size="1px">{$addressTR}</font></strong></td>

    </tr>

    <tr>

      <td style="height:10px;" width="33%" valign="top">SIGNED <b><span style="font-size:11px;"><font color="#000000"  >{$hicdata.0.signed}</font></span></b></td>

      <td width="12%" valign="top" style="border-right:#fb070e 1px solid;">DATE &nbsp;<br/> <span style="font-size:10px;"><font color="#000000"  >{$appm}-{$appd}-{$app2y}</font></span></td>

      <td width="25%" valign="middle" style="border-right:#fb070e 1px solid; border-top:#fb070e 1px solid;">a.<b><font color="#000000" size="1px">1013282433</font></b></td>

      <td width="30%" valign="middle" style="border-top:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">b. <b><font color="#000000" size="1px">&nbsp;{$hicdata.0.provider}</font></b></td>

    </tr>

  </table></td>

  <td valign="top" style=" border-right:#fb070e 1px solid;  border-bottom:#fb070e 1px solid;"><table width="100%" border="0" cellpadding="0" cellspacing="0">

    <tr>

      <td colspan="2" valign="top" style=" height:11px;">33. BILLING PROVIDER INFO & PH #</td>

    </tr>

    <tr>

      <td colspan="2" style=" height:30px;"  align="center"><b><font color="#000000" size="1px" >{$hicdata.0.billingaddr} <br />

        TEL:{$hicdata.0.billingphone}</font></b></td>

      </tr>

    <tr>

      <td width="47%" valign="middle" style=" height:12px; border-right:#fb070e 1px solid; border-top:#fb070e 1px solid;" >a.<b><font color="#000000" size="1px">1013282433</font></b></td>

      <td width="53%" valign="middle" style="border-top:#fb070e 1px solid; background-color:#ffe5d8;" class="bg_col">b.  <b><font color="#000000" size="1px">&nbsp;{$hicdata.0.provider}</font></b></td>

    </tr>

  </table></td>

</tr>

<tr>

  <td>&nbsp;</td>

  <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>

      <td width="36%" height="25" align="left" valign="middle">NUCC Instruction Manual available at :www.nucc.org</td>

      <td width="19%" align="center" valign="middle" style="font-size:12px; font-style:italic; font-weight:bold;" ></td>

      <td width="45%" align="right" valign="middle">APPROVED OMB-0938-0999 FORM CMS-1500(08-05) </td>

    </tr>

  </table></td>

  <td>&nbsp;</td>

</tr>

</table>

</div>



</div>
		