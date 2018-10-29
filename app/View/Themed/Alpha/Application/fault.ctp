<div id="p2_sec01_wrap">
</div>
<div class="container">
  <div class="row">
      <div class="col-sm-12">
      <ul id="applicationtabnav" class="nav nav-justified nav-wizard">
                  <li id="li1"><a>Personal Info</a></li>
                  <li id="li2"><a>Verify Identity</a></li>
                  <li id="li3"><a>Employment Info</a></li>
                  <li id="li6" <?php if($this->Session->read('Application.CoApplicant') == 'No' || $this->Session->check('Application.CoApplicant') == false || $this->Session->read('Application.AppType') == 'payday'){echo "style='display:none'";}?>><a>Co-Applicant Info</a></li>
                  <li id="li4"><a>Deposit Cash</a></li>
                  <li id="li5" class="active"><a href="#tab5" data-toggle="tab">Communication Error</a></li>
              </ul>
          <form method="post" id="basicWizard" class="panel-wizard">        
              <div class="tab-content">
                  <div class="tab-pane tab5" id="tab5" style="display:initial;">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">
                              <strong>Communication Error:</strong> <span style="font-size: 14px">We have matched you with our <strong><em>Elite Lenders</em></strong></span>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                      <div class="col-sm-4 text-center">
                      <?php echo $this->Html->link($this->Html->image('OneMain-Banner.jpg', array('alt'=>'NetCredit', 'width'=>'340', 'height'=>'270', 'class'=>'img-responsive')), 'http://nkoeg.com/?c=108&s1=CommErr', array('target'=>'_blank','escape'=>false)); ?>
                       
                      </div>
                      <div class="col-sm-4 text-center" id="app_img">
                      <?php echo $this->Html->image('submit-app.png', array('alt'=>'Submit application directly', 'width'=>'323', 'height'=>'62', 'class'=>'img-responsive', 'style'=>'margin-top: 75px;')); ?>
                      
                      </div>
                      <div class="col-sm-4 text-center">
                      <?php echo $this->Html->link($this->Html->image('prosper-banner.png', array('alt'=>'Prosper', 'width'=>'340', 'height'=>'270', 'class'=>'img-responsive')), 'http://nkoeg.com/?c=83&s1=CommErr', array('target'=>'_blank','escape'=>false)); ?>
                      </div>
                    </div>
                    
                    <div class="row" style="text-align:center;">
                        <div class="col-sm-12">
                        <br/>
                          <p>Your data is safe and we have created a ticket to resolve this issue.</p>
                        </div>
                      </div>
                  </div><!-- tab-pane -->
                  
              </div><!-- tab-content -->
              <ul class="list-unstyled wizard"></ul>
          </form><!-- #basicWizard -->
        </div>
    </div>
</div>