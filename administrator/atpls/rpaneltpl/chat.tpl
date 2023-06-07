


   <link href="../theme/bootstrap.css" rel="stylesheet" />

<div class="container">
    <div class="row form-group">
        <div class="col-xs-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="comment"></span> Chat History
                </div>
                <div class="panel-body body-panel" style=" height:500px; overflow:scroll;">
                    <ul class="chat">

                       <table width="100%" border="0">
  


                       
                      {section name=q loop=$data}
                      {if $data[q].from eq 'admin'}
                      <tr>
    <td  style=" border-bottom: solid 1px #000;">
                        <li class="left message-sdfs clearfix"><span class="chat-img pull-left">
                            <div class="img-circle user-cir">Admin  &raquo; {$data[q].fname} {$data[q].lname}</div>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">&nbsp;</strong> 
                                    <small class="pull-right message text-muted">{$data[q].sent|date_format:"%m/%d/%Y %I:%M"} {$data[q].sent|date_format:"%p"}</small>
                                </div>
                                <p class="para">
                                    &nbsp;&nbsp;{$data[q].message}
                                </p>
                            </div>
                        </li> </td></tr>
                        {else}
                        <tr>
    <td  style=" border-bottom: solid 1px #000;">
                      		  <li class="right message clearfix"><span class="chat-img pull-right">
                            <div class="img-circle user-cir-me"> {$data[q].fname} {$data[q].lname}</div>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted">{$data[q].sent|date_format:"%m/%d/%Y %I:%M"} {$data[q].sent|date_format:"%p"}</small>
                                    <strong class="pull-right primary-font">&nbsp;</strong>
                                </div>
                                <p>
                                   {$data[q].message}
                                </p>
                            </div>
                        </li></td></tr>
                        {/if}
                       
                      {/section}
                     </table>
                    </ul>
                </div>
               <!--<div class="panel-footer">
                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Message">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="button">SEND</button>
                                    </span>
                                </div>
            </div>-->
            </div>
        </div>
    </div>
</div>
<script>
$(document).scrollTop($(document).height());
</script>