{include file="headernew.tpl"}


<div class="submain"  style="min-height:400px;">
	<div class="wrap" style="padding-bottom:20px;">
      <h1>Account SignUp </h1><hr/>  
      <table>
      {section name=index loop=$errors}
        <h5 style="color: red;">{$errors[index]}</h5>
      {/section}
      {section name=index loop=$messages}
        <h5 style="color: green;">{$messages[index]}</h5>
      {/section}
        <form action="signup.php" method="post" autocomplete="off">
            <tr>
                <th>Facility Name : </th>
                <td>
                    <input type="text" name="facility_name" id="facility_name" required> *
                </td>
            </tr>
            <tr>
                <th>Contact Person Name : </th>
                <td>
                    <input type="text" name="person_name" id="person_name" required> *
                </td>
            </tr>
            <tr>
                <th>Phone Number : </th>
                <td>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="(999)-999 9999" required> *
                </td>
            </tr>
            <tr>
                <th>Email Address : </th>
                <td>
                    <input type="email" name="email" id="email" required> *
                </td>
            </tr>
            <tr>
                <th>Client Address : </th>
                <td>
                    <input type="text" name="client_address" id="client_address" >
                </td>
            </tr>
            <tr>
                <th>
                    <input type="submit" value="Submit" class="btn btn-primary btn-md" name="submit">
                </th>
            </tr>
            </form>
        </table>

</div>
{literal}
<script>
document.getElementById('phone_number').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\A/g, '').match(/(\d{3})(\d{3})(\d{4})/);
        e.target.value = '(' + x[1] + ')-' + x[2] +' '+ x[3];
});
</script>
{/literal}    
{include file="footerlast.tpl"}