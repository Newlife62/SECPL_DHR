<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-book"></i> Share/Loan Ledger</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Share Ledger</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12" >
            <div class="tile">
                <div class="tile-body ">
                    <div class="row">
                        <div class="col-sm-3" >
                            <label>From</label>
                            <input type="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="col-sm-3" >
                            <label>To</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                        <div class="col-sm-3" >
                            <label>School</label>
                            <select id="schools" class="form-control">
                                 <option value="">Select The School</option>
                                <?php foreach($schoolslist->result_array() as $school){ ?>
                                <option value="<?php echo $school['id'];?>" ><?php echo $school['school_name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-3" >
                            <label>Teacher</label>
                            <select id="teachers" class="form-control">
                                 <option value=""> Select Teacher </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12" >
                            <br>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12" id="shareledger">
                            
                        </div>
                    </div>
                </div>
            </div>


        </div>
      </div>
</main>

