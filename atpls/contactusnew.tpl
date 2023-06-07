{include file="headernew.tpl"}
{*include file="slidernew.tpl"*}

            
            <section class="section gray">
    <div class="w-container">
      <div class="top-title">
        <div class="title-txt">
        <h1>Drop Your Message</h1>
        </div>
        <div class="divider"></div>
        <div class="w-col-12">
        <div class="w-col-12">
            
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form11" class="contact-form" name="contact-form" method="post" action="sendemailnew.php">
                <div class="row">
						<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Name *</span>
								<input type="text" name="name" class="form-control" placeholder="Enter Your Name" required="required">								
							</div>
						</div>
						<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Email *</span>
							<input type="text" name="email" class="form-control" placeholder="Enter Your Email" required="required">
							</div>
						</div>
					</div>
                    <div class="row">
						<div class="col-sm-12" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Message *</span>
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Enter Your Message"></textarea>
							</div>
						</div>
							</div>
                       <div class="row">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Send Message</button>
                        </div>
                   </div>
                </form> 
            </div>
            
             </div>
        </div>
      </div>
      <div>
      </div>
     </div> 
    </section>
            
{include file="footernew.tpl"}