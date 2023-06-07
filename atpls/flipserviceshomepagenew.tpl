<!-- START SECTION 3 -->
  <section class="w-section section">
    <div class="w-container">
      <div>
        <div class="w-row">
        <div class="col-md-12 col-md-12">
            <div class="accordion">
                <div class="panel-group" id="accordion1">
                   {section name=q loop=$servicesdata}
                    <div class="panel panel-default ">
                    <div class="panel-heading {if $smarty.section.q.iteration eq '1'} active {/if}">
                      <h3 class="panel-title">
                       <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne{$servicesdata[q].id}" aria-expanded="false">
                          {$servicesdata[q].title} <i class="fa fa-angle-right pull-right"></i>
                        </a>
                      </h3>
                    </div>
                    <div id="collapseOne{$servicesdata[q].id}" class="panel-collapse collapse " aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
                        <div class="media accordion-inner">
                        <div class="pull-left">
                        <img class="img-responsive" src="{$servicesdata[q].image}" width="400px" height="226px;">
                        </div>
                        <div class="media-body">
                         <p>{$servicesdata[q].content}</p>
                      </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  {/section}
                </div>
                <!--/#accordion1-->
            </div>
        </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END SECTION 3 -->