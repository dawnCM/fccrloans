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
                
              </ul>
          <form method="post" id="basicWizard" class="panel-wizard" >      	
              <div class="tab-content amount-wrap">
                   
                 <p><?php echo $this->Session->read('Application.FirstName'); ?>,please complete your loan request.</p> 

                 <p><h6>We were not able to connect you with a personal loan lenders at this time</h6></p> 

                 <p>Good News,you may qualify for a short-term loan.</p> 

                 <p>Select a loan amount up to $1000 to continue.</p>

                 <div class="col-md-4"></div>
                 <div class="col-md-4">

                 <div class="col-md-1"></div>
                    <div class="form-group col-md-10">
                      <select class="form-control" id='LoanAmount' name='LoanAmount'>
                        <option value="">-Choose Amount-</option>
                          <?php 
                          foreach($LoanAmount as $key=>$value){
                            if($key=='1001'){$key='600';}
                            echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                          }
                          ?>
                      </select>
                    </div>
                    <?php
                    if(empty($this->Session->read('Application.LoanAmount1'))){?>

                            <input type='hidden1' id='LoanAmount1' name='LoanAmount1' value="<?php echo $this->Session->read('Application.LoanAmount');?>" >

                  
                    <?php
                    }else{
                    ?>
                    
                         <input type='hidden1' id='LoanAmount2' name='LoanAmount2' value="<?php echo $this->Session->read('Application.LoanAmount1');?>" >

                         <input type='hidden1' id='LoanAmount1' name='LoanAmount1' value="<?php echo $this->Session->read('Application.LoanAmount');?>" >
                    <?php
                    }
                    ?>

                 <div class="col-md-1"></div>   

                    <div class="form-group">
                       <button type="btn" class="btn btn-custom" id="second_loan">Click to Continue</button>
                    </div>

                  <p><u>No Thank You</u></p>  

                 </div><!-- input-form-wrap -->
                 <div class="col-md-4"></div>
                  
              </div><!-- tab-content -->
              <ul class="list-unstyled wizard"></ul>
          </form><!-- #basicWizard -->
        </div>
    </div>
</div>
<style type="text/css">   
                             .panel-wizard .tab-content.amount-wrap{                  background: #579301;                  color: #fff;                  padding: 20px;                  text-align: center;                }                  .panel-wizard .tab-content.amount-wrap .btn.btn-custom {                  color: #000;                  padding: 5px 30px;                  background: #d1ca12;                  border: 1px solid #d1ca12;                  border-radius: 15px;                  font-weight: bold;                }              </style>