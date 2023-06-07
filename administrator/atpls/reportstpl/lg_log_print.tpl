 {literal}
   <style type="text/css">
     * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
     }

     body {
       font-family: Arial, Helvetica, sans-serif;
       line-height: 1.4;
     }

     .container {
       width: 100%;
       margin: auto;
     }

     .centeralize {
       text-align: center;
     }

     table {
       border-collapse: collapse;
       width: 100%;
     }

     .row {
       display: flex;
     }

     #printable {
       display: block;
     }

     @media print {
       #non-printable {
         display: none;
       }

       #printable {
         display: block;
       }
     }
   </style>
{/literal}
<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
    <div class="container">
      <h3 class="centeralize">Virginia Non-Emergency Transportation Trip Log</h3>
      <div class="row" style="width: 100%;">
        <div class="col centeralize" style="width: 33%;">
          <img src="../images/logisticareLogo.png" alt="" width="140px">
        </div>
        <div class="col centeralize" style="line-height: 0.6; width: 33%;">
          <h4>LogistiCare Solutions, LLC</h4>
        </div>
        <div class="col" style="width: 33%;">
          <p style="text-align: center; font-weight: 600; font-size: 14px;">Matil to: <br> LogistiCare Claims Department P.O. Box 248  Norton, VA 24273</p>
        </div>
      </div>
      <table style="width: 100%;">
        <tr class="centeralize">
          <td class="column" style="border-bottom: 1px solid #000; width: 30%; font-weight: 600;">Van's Med Tec Transport</td>
          <td></td>
          <td class="column" style="border-bottom: 1px solid #000; width: 30%;">{$stdate|date_format:"%m/%d/%Y"}
            -{$enddate|date_format:"%m/%d/%Y"}</td>
          <td></td>
          <td class="column" style="border-bottom: 1px solid #000; width: 30%;">{$dataV.vin|substr:-6}</td>
        </tr>
        <tr class="centeralize">
          <td style="margin-right: 40px;">Provider Name:</td>
          <td></td>
          <td>WEEK ENDING:</td>
          <td></td>
          <td><span style="font-weight: 600;">Vehicle Number </span>(List last six digits of the VIN)</td>
        </tr>
        <tr class="centeralize">
          <td style="border-bottom: 1px solid #000; width: 33%; font-weight: 600;">V458</td>
          <td></td>
          <td style="border-bottom: 1px solid #000;">{$stdate|date_format:"%m/%d/%Y"}</td>
        </tr>
        <tr class="centeralize">
          <td>Provider ID:</td>
          <td></td>
          <td>Start Time From Base</td>
          <td></td>
        </tr>
        <tr class="centeralize">
          <td style="border-bottom: 1px solid #000; width: 33%; padding-top: 20px;">{$data.0.name}</td>
          <td></td>
          <td style="border-bottom: 1px solid #000;">{$enddate|date_format:"%m/%d/%Y"}</td>
        </tr>
        <tr class="centeralize">
          <td><span style="font-weight: 600;"> Driver's Name </span>(as it appears on drivers license)</td>
          <td></td>
          <td>Return Time To Base</td>
          <td></td>
        </tr>
        <tr class="centeralize">
          <td style="border-bottom: 1px solid #000; width: 33%; padding-top: 20px;"></td>
        </tr>
        <tr class="centeralize">
          <td><span style="font-weight: 600;">Attendant's Full Name </span>(as it appears on drivers license)</td>
        </tr>
      </table>
      <table style="border: 1px solid #000; width: 100%; margin-top: 10px;">
        <tr style="font-size: 14px;">
          <th style="border: 1px solid #000;">Date of Services</th>
          <th style="border: 1px solid #000;">LogistiCare Job # A or B</th>
          <th style="border: 1px solid #000;">Member's Name</th>
          <th style="border: 1px solid #000;">T W A VS</th>
          <th style="border: 1px solid #000;">RNS</th>
          <th style="border: 1px solid #000;">Pick-up Time</th>
          <th style="border: 1px solid #000;">Drop-Off Time</th>
          <th style="border: 1px solid #000;">Will Call Time</th>
          <th style="border: 1px solid #000;">Total Trip Mileage</th>
          <th style="border: 1px solid #000;">Wait Time</th>
          <th style="border: 1px solid #000;">Per Trip Billed Amount</th>
          <th style="border: 1px solid #000;">Number of Attendants, Children or Wheelchair</th>
          <th style="border: 1px solid #000;">Member's Signature or Attendant's Signature (if applicable)</th>
        </tr>
        {section name=q loop=$data}
        <tr style="font-size: 13px;">
          <td style="border: 1px solid #000;">{$data[q].date|date_format:"%m/%d/%Y"}</td>
          <td style="border: 1px solid #000;"></td>
          <td style="border: 1px solid #000;">{$data[q].trip_user}</td>
          <td style="border: 1px solid #000;">{$data[q].vehtype|substr:0:1}</td>
          <td style="border: 1px solid #000;">{if $data[q].status eq '7' || $data[q].status eq '8'} Yes {/if}</td>
          <td style="border: 1px solid #000;">{if $data[q].aptime eq '00:00:00'}--:--{else}{$data[q].aptime|date_format:"%I:%M"}<!-- {$data[q].aptime|date_format:"%p"}-->{/if}</td>
          <td style="border: 1px solid #000;">{if $data[q].drp_atime eq '00:00:00'}--:--{else}{$data[q].drp_atime|date_format:"%I:%M"}<!-- {$data[q].drp_atime|date_format:"%p"}-->{/if}</td>
          <td style="border: 1px solid #000;"></td>
          <td style="border: 1px solid #000;">{$data[q].trip_miles}</td>
          <td style="border: 1px solid #000;">{$data[q].wait_time}</td>
          <td style="border: 1px solid #000;">$ {$data[q].charges}</td>
          <td style="border: 1px solid #000;">{$data[q].att}</td>
          <td style="border: 1px solid #000;">{if $data[q].signature neq ''}<img src="../../iphone/signature/{$data[q].signature}" width="100" height="50" />{/if}</td>
        </tr>
      {/section}
      </table>
      <p style="font-size: 11px;">**NOTE*** <strong>Leg of transport --</strong> a leg of transport is the point of pick-up to the destination. Example: Picking recipient up at residence and transporting to the doctor's office would be considered one leg; picking the recipient up at the doctor's office and transporting back to the residence would considered the second leg of the trip. Each leg of the transport must be documented on separate lines. A signature is required for each leg of the transport. Pick-up and drop-off times must be documented and in military time.</p>

      <table style="line-height: 0.6; margin-top: 10px;">
        <tr>
          <td style="font-size: 15px; font-weight: 600; width: 15%;">Driver's Comments:</td>
          <td style="border-bottom: 1px solid #000; width: 85%;"></td>
        </tr>
        <tr>
          <td></td>
          <td style="border-bottom: 1px solid #000; width: 940px; padding-top: 26px;"></td>
        </tr>
      </table>

      <p style="font-weight: 600; font-size: 13px; text-align: center;">I understand that LogistiCare will verify the accordance of the mileage being reported hereby certify the information herein is true, correct, and accurate.</p>

      <table>
        <div class="row" style="width: 100%;">
          <tr style="font-size: 13px;">
            <td style="font-weight: 600; width: 20%;">Driver's/ Provider's Name <u>(must print):</u></td>
            <td style="border-bottom: 1px solid #000; width: 30%;">{$data.0.name}</td>
            <td style="font-weight: 600; width: 15%;">Driver's/ Provider's Signature:</td>
            <td style="border-bottom: 1px solid #000; padding-top: 23px; width: 35%;">{if $data.0.drsignature neq ''}<u><img src="../{$data.0.drsignature}" width="120" height="60" /></u>{/if}</td>
          </tr>
          <tr>
        </div>
        <div class="row" style="width: 100%;">
          <tr style="font-size: 13px;">
            <td style="font-weight: 600; width: 20%;">Attendant Name <u> (must print):</u></td>
            <td style="border-bottom: 1px solid #000; width: 30%;"></td>
            <td style="font-weight: 600; width: 15%;">Attendant Signature:</td>
            <td style="border-bottom: 1px solid #000; padding-top: 23px; width: 35%;"></td>
          </tr>
          <tr>
        </div>
      </table>
    </div>
  </div>
</div>

