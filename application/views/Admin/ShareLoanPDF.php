<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Schools List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Schools List</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
           <div class="tile">
                <div class="tile-body ">
                    <div class="row">
                    	<div class="col-sm-3" ></div>
                         <div class="col-sm-6" >
                         	<select  class="form-control" name="school_id" id="school_id" placeholder="school name" style="width:100%;" required>
                                    <option value="">Select The School</option>
                                    
                                    <?php foreach($schoolslist->result_array() as $school){ ?>
                                    <option value="<?php echo $school['id'];?>" ><?php echo $school['school_name'];?> SCHOOL</option>
                                    <?php } ?>
                                    </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="loansharepdf">
    
                        </div>
                    </div>
                </div>
             </div>

       

        </div>
      </div>
    </main>