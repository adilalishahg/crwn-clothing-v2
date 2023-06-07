{ include file = mainhead.tpl}

<table width="1010" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">

  <tr>

     <td width="18%" height="44" align="left" valign="top">

	  {if $smarty.session.admuser.admin_level eq '0'}

	  <table width="50%" border="0" align="center" cellpadding="2" cellspacing="2">

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

          <Td width="108" align="center" valign="top"><!--<a href="members/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image36','images/cp_13rolover.png',0,0,1,1)"><img src="images/cp_13.gif" name="Image36" width="108" height="70" border="0"><br />

		  Members Managment </a>-->

		  

<a href="corporate/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image14','images/cp_35rolover.png',0,0,1,1)"><img src="images/cp_35.gif" name="Image14" width="109" height="67" border="0"><br />

		  Corporations

		  </a>		  

		  </Td>

        <Td width="116">&nbsp;</Td>

          <td width="109" align="center" valign="top"><a href="reports/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image13','images/cp_28rolove.png',0,0,1,1)"><img src="images/cp_28.gif" name="Image13" width="111" height="67" border="0"><br />

		  Reports

		  </a></td>

        <td width="108">&nbsp;</td>

          <td width="113" align="center" valign="top"><a href="requests/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image10','images/cp_18rolover.png',0,0,1,1)"><img src="images/cp_18.gif" name="Image10" width="111" height="70" border="0"><br />Trip Requests</a>

            </td>

      </tr>

      

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="111" align="center" valign="top"><a href="testimonials/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image11','images/cp_26rolove.png',0,0,1,1)"><img src="images/cp_26.gif" name="Image11" width="109" height="67" border="0"><br />Testimonials Section</a><a href="javascript:;" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image361','images/cp_13rolover.png',0,0,1,1)"><span class="text"></span></a></Td>

          <Td width="179">&nbsp;</Td>

          <td width="109" align="center" valign="top"><a href="cms/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image12','images/cp_27rolover.png',0,0,1,1)"><img src="images/cp_27.gif" name="Image12" width="109" height="67" border="0">

		  Content Management

		  </a>

            </td>

          <td width="168">&nbsp;</td>

          <td width="111" align="center" valign="top"><a href="drivers/"  onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image15','images/cp_36rolover.png',0,0,1,1)"><img src="images/cp_36.gif" name="Image15" width="109" height="67" border="0"><br />

		  Drivers Management

		  </a></td>

        </tr>

        

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="23%" align="center" valign="top"><a href="routingpanel" ><img src="images/Routing.gif" name="Image9" width="109" height="70" border="0"><br />

            Routing Sheets</a></Td>

          <Td width="17%">&nbsp;</Td>

          <td width="22%" align="center" valign="top"><a href="admin_profile.php" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image9','images/cp_16rolover.png',0,0,1,1)"><img src="images/cp_16.gif" name="Image9" width="109" height="70" border="0"><br />

            Account Settings</a></td>

          <td width="16%">&nbsp;</td>

          <td width="22%" align="center" valign="top"><a href="vehicles/"  onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image16','images/cp_37rolover.png',0,0,1,1)"><img src="images/cp_37.gif" name="Image16" width="111" height="67" border="0"><br />

		  Vehicles Management

		  </a>

            </td>

        </tr>

        

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="23%" align="center" valign="top"><!--<a href="javascript:;" onclick="alert('This module is not integrated by Hybrid IT Services, for details email at support@hybridTracktrans.com.\n Thank you!'); return false;"><img src="images/Routing.gif" name="Image9" width="109" height="70" border="0"><br />

            Routing Section</a>--></Td>

          <Td width="17%">&nbsp;</Td>

          <td width="22%" align="center" valign="top"><!--<a href="admin_profile.php" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image9','images/cp_16rolover.png',0,0,1,1)"><img src="images/cp_16.gif" name="Image9" width="109" height="70" border="0"><br />

            Accout Settings</a>--></td>

          <td width="16%">&nbsp;</td>

          <td width="22%" align="center" valign="top"><a href="javascript:;" onclick="alert('This module is not integrated by Hybrid IT Services, for details email at support@hybridTracktrans.com.\n Thank you!'); return false;"><img src="images/lock.gif" name="Image16" width="111" height="67" border="0"><br />Lock

          </a>

            </td>

        </tr>

        

    </table></td>

                                </tr>								

                              </table>							 

	  {else}

	  <table width="50%" border="0" align="center" cellpadding="2" cellspacing="2">

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

          <Td width="108" align="center" valign="top"><a href="drivers" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image15','images/cp_36rolover.png',0,0,1,1)"><img src="images/cp_36.gif" name="Image15" width="109" height="67" border="0"><br />

		  Drivers Management

		  </a>		  

		  </Td>

          <Td width="116">&nbsp;</Td>

          <td width="109" align="center" valign="top"><a href="vehicles" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image16','images/cp_37rolover.png',0,0,1,1)"><img src="images/cp_37.gif" name="Image16" width="111" height="67" border="0"><br />

		  Vehicles Management

		  </a></td>

          <td width="108">&nbsp;</td>

          <td width="113" align="center" valign="top"><a href="attandance/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image10','images/attendance.gif',0,0,1,1)"><img src="images/attendance.gif" name="Image10" width="108" height="70" border="0"><br />

            Attandance</a></td>

      </tr>

      

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="110" align="center" valign="top"><a href="routingpanel" ><img src="images/Routing.gif" name="Image9" width="109" height="70" border="0"><br />

            Routing Sheets</a></Td>

          <Td width="86">&nbsp;</Td>

          <td width="111" align="center" valign="top"><!--<a href="javascript:;" onclick="alert('This module is not integrated by Hybrid IT Services, for details email at support@hybridTracktrans.com.\n Thank you!'); return false;"><img src="images/lock.gif" name="Image16" width="111" height="67" border="0"><br />

            Lock

          </a>-->

            </td>

          <td width="77">&nbsp;</td>

          <td width="113" align="center" valign="top"><!--<a href="reports/" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image13','images/cp_28rolove.png',0,0,1,1)"><img src="images/cp_28.gif" name="Image13" width="111" height="67" border="0"><br />

		  Reports

		  </a>--></td>

        </tr>

        

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="23%" align="center" valign="top">&nbsp;</Td>

          <Td width="17%">&nbsp;</Td>

          <td width="22%" align="center" valign="top">&nbsp;</td>

          <td width="16%">&nbsp;</td>

          <td width="22%" align="center" valign="top">&nbsp;</td>

        </tr>

        

    </table></td>

                                </tr>

                                <tr>

                                  <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <Td width="23%" align="center" valign="top"><!--<a href="javascript:;" onclick="alert('This module is not integrated by Hybrid IT Services, for details email at support@hybridTracktrans.com.\n Thank you!'); return false;"><img src="images/Routing.gif" name="Image9" width="109" height="70" border="0"><br />

            Routing Section</a>--></Td>

          <Td width="17%">&nbsp;</Td>

          <td width="22%" align="center" valign="top"><!--<a href="admin_profile.php" onMouseOut="flvFSTI2()" onMouseOver="flvFSTI1('Image9','images/cp_16rolover.png',0,0,1,1)"><img src="images/cp_16.gif" name="Image9" width="109" height="70" border="0"><br />

            Accout Settings</a>--></td>

          <td width="16%">&nbsp;</td>

          <td width="22%" align="center" valign="top"><a href="javascript:;" onclick="alert('This module is not integrated by Hybrid IT Services, for details email at support@hybridTracktrans.com.\n Thank you!'); return false;"><br />

          </a></td>

        </tr>

        

    </table></td>

                                </tr>								

                              </table>

	  {/if}

	 </td>

  </tr>

</table>

{ include file = innerfooter.tpl}

