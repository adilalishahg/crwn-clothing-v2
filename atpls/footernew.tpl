<section class="contact-bg"> 
      <div class="container">
        <div class="row">
            <div class="col-sm-4 contact-center"> 
              <div class="full-right">
                <img src="images/location.png" alt="Location image" class="img-posi">
                <p  style="color:#FFF; font-weight:bold; font-size:18px;">  {$contactinfo.address},<br> {$contactinfo.city},  {$contactinfo.state}, {$contactinfo.zip}</p>
              </div>
            </div>
            <div class="col-sm-4 contact-center"> 
              <div class="full-right">
                <img src="images/phone.png" alt="Location image" class="img-posi">
                <p style="color:#FFF; font-weight:bold; font-size:20px;">{$contactinfo.phone}<br>
                </p>
              </div>
            </div>
            <div class="col-sm-4 contact-center">
              <div class="full-right">
                <img src="images/email.png" alt="Location image" class="img-posi">
                <p><a href="mailto:{$contactinfo.email}"  style="color:#FFF; font-weight:bold; font-size:20px;">{$contactinfo.email}</a><br>
                </p>
              </div>
            </div>
        </div>
      </div>
    </section>
  <!-- FOOTER --> 
  <footer class="footer">
    <div class="w-container">
      <div class="w-row">
                    <div class="col-md-6">
							<ul class="media-list contact-list">
                            <li class="media">
                                <div class="media-left"><i class="fa fa-home"></i></div>
                                <div class="media-body"> {$contactinfo.address}, </div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa"></i></div>
                                <div class="media-body">{$contactinfo.city}, {$contactinfo.state},{$contactinfo.zip}</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-phone"></i></div>
                                <div class="media-body">Support Phone:{$contactinfo.phone}</div>
                            </li>
                            <li class="media">
                                <div class="media-left"><i class="fa fa-envelope"></i></div>
                                <div class="media-body"><a href="E mails:{$contactinfo.email}">{$contactinfo.email}</a></div>
                            </li>
                            
							<li class="media">
                                <div class="media-left"><i class="fa fa-clock-o"></i></div>
                                <div class="media-body">Working Hours: {$contactinfo.starttime|substr:0:5}-{$contactinfo.endtime|substr:0:5}</div>
                            </li>
							
                        </ul>

                    </div>
            
        
      </div>
    </div>
{include file="footerlast.tpl"}