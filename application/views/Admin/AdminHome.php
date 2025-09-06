<?php 
                $this->db
                        ->select('count(s.id) schoolscount')
                        ->from('companys_detail s');
                $schools = $this->db->get();
                foreach($schools->result_array() as $schoolsdata);              

                $this->db
                        ->select('count(t.id) teacherscount')
                        ->from('employees t');
                $teachers = $this->db->get();
                foreach($teachers->result_array() as $teachersdata);

                // Get some stage counts for analytics
                $stage_counts = array();
                for($i = 1; $i <= 4; $i++) {
                    $this->db->select('count(*) as stage_count')
                             ->from('dhr_records')
                             ->where('stage_no', $i)
                             ->where('status', 'active');
                    $result = $this->db->get();
                    $stage_counts[$i] = $result->row_array()['stage_count'] ?? 0;
                }
?>

<style>
    /* Enhanced Dashboard Styles */
    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .dashboard-welcome {
        text-align: center;
    }
    
    .dashboard-welcome h1 {
        font-size: 2.5rem;
        font-weight: 300;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .dashboard-welcome p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-gradient));
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .stats-card.company:before { --card-gradient: #667eea, #764ba2; }
    .stats-card.employees:before { --card-gradient: #f093fb, #f5576c; }
    .stats-card.stage1:before { --card-gradient: #4facfe, #00f2fe; }
    .stats-card.stage2:before { --card-gradient: #43e97b, #38f9d7; }
    .stats-card.stage3:before { --card-gradient: #fa709a, #fee140; }
    .stats-card.stage4:before { --card-gradient: #a8edea, #fed6e3; }
    
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
    }
    
    .stats-icon.company { background: linear-gradient(135deg, #667eea, #764ba2); }
    .stats-icon.employees { background: linear-gradient(135deg, #f093fb, #f5576c); }
    .stats-icon.stage1 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
    .stats-icon.stage2 { background: linear-gradient(135deg, #43e97b, #38f9d7); }
    .stats-icon.stage3 { background: linear-gradient(135deg, #fa709a, #fee140); }
    .stats-icon.stage4 { background: linear-gradient(135deg, #a8edea, #fed6e3); }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    
    .stats-label {
        font-size: 1rem;
        color: #7f8c8d;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .stats-change {
        font-size: 0.85rem;
        color: #27ae60;
        font-weight: 500;
    }
    
    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .quick-actions h3 {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    
    .action-btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        margin: 0.25rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .action-btn.primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .action-btn.success {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
        color: white;
    }
    
    .action-btn.info {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: white;
    }
    
    .action-btn.warning {
        background: linear-gradient(135deg, #fa709a, #fee140);
        color: white;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        text-decoration: none;
        color: white;
    }
    
    .stage-workflow {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .stage-workflow h3 {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    
    .workflow-step {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin: 0.5rem 0;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        border-left: 4px solid transparent;
    }
    
    .workflow-step:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
    
    .workflow-step.stage-1 { border-left-color: #4facfe; }
    .workflow-step.stage-2 { border-left-color: #43e97b; }
    .workflow-step.stage-3 { border-left-color: #fa709a; }
    .workflow-step.stage-4 { border-left-color: #a8edea; }
    
    .workflow-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.1rem;
    }
    
    .workflow-icon.stage-1 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
    .workflow-icon.stage-2 { background: linear-gradient(135deg, #43e97b, #38f9d7); }
    .workflow-icon.stage-3 { background: linear-gradient(135deg, #fa709a, #fee140); }
    .workflow-icon.stage-4 { background: linear-gradient(135deg, #a8edea, #fed6e3); }
    
    .workflow-content h5 {
        margin: 0 0 0.25rem 0;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .workflow-content p {
        margin: 0;
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    .workflow-count {
        margin-left: auto;
        background: #e9ecef;
        color: #495057;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .dashboard-welcome h1 {
            font-size: 2rem;
        }
        
        .stats-number {
            font-size: 2rem;
        }
        
        .action-btn {
            display: block;
            margin: 0.5rem 0;
            text-align: center;
        }
    }
</style>

<main class="app-content">
    <!-- Enhanced Dashboard Header -->
    <div class="dashboard-header">
        <div class="container-fluid">
            <div class="dashboard-welcome">
                <h1><i class="fa fa-tachometer"></i> Admin Dashboard</h1>
                <p>Welcome back! Here's what's happening with your Device History Records.</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card company" onclick="window.location='<?=base_url('AdminController/AddSchools');?>'">
                <div class="stats-icon company">
                    <i class="fa fa-building"></i>
                </div>
                <div class="stats-number"><?php echo $schoolsdata['schoolscount']==''?0:$schoolsdata['schoolscount'];?></div>
                <div class="stats-label">Total Companies</div>
                <div class="stats-change">
                    <i class="fa fa-arrow-up"></i> Active organizations
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stats-card employees" onclick="window.location='<?=base_url('staff_list/ALL');?>'">
                <div class="stats-icon employees">
                    <i class="fa fa-users"></i>
                </div>
                <div class="stats-number"><?php echo $teachersdata['teacherscount']==''?0:$teachersdata['teacherscount'];?></div>
                <div class="stats-label">Total Employees</div>
                <div class="stats-change">
                    <i class="fa fa-users"></i> Active workforce
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stage1" onclick="window.location='<?=base_url('AdminController/StageOneOrdersList');?>'">
                <div class="stats-icon stage1">
                    <i class="fa fa-flask"></i>
                </div>
                <div class="stats-number"><?php echo $stage_counts[1]; ?></div>
                <div class="stats-label">Stage-1 Records</div>
                <div class="stats-change">
                    <i class="fa fa-cog"></i> In production
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stage2" onclick="window.location='<?=base_url('AdminController/StageTwoOrdersList');?>'">
                <div class="stats-icon stage2">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="stats-number"><?php echo $stage_counts[2]; ?></div>
                <div class="stats-label">Stage-2 Records</div>
                <div class="stats-change">
                    <i class="fa fa-check"></i> Quality checked
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row of Statistics -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stage3" onclick="window.location='<?=base_url('AdminController/StageThreeOrdersList');?>'">
                <div class="stats-icon stage3">
                    <i class="fa fa-cogs"></i>
                </div>
                <div class="stats-number"><?php echo $stage_counts[3]; ?></div>
                <div class="stats-label">Stage-3 Records</div>
                <div class="stats-change">
                    <i class="fa fa-gear"></i> Processing
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stage4" onclick="window.location='<?=base_url('AdminController/StageFourOrdersList');?>'">
                <div class="stats-icon stage4">
                    <i class="fa fa-star"></i>
                </div>
                <div class="stats-number"><?php echo $stage_counts[4]; ?></div>
                <div class="stats-label">Stage-4 Records</div>
                <div class="stats-change">
                    <i class="fa fa-trophy"></i> Completed
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <!-- Quick Actions Panel -->
            <div class="quick-actions">
                <h3><i class="fa fa-bolt"></i> Quick Actions</h3>
                <div class="text-center">
                    <a href="<?=base_url('AdminController/AddSchools');?>" class="action-btn primary">
                        <i class="fa fa-plus"></i> Add Company
                    </a>
                    <a href="<?=base_url('staff_list/ALL');?>" class="action-btn success">
                        <i class="fa fa-user-plus"></i> Add Employee
                    </a>
                    <a href="<?=base_url('AdminController/COAList');?>" class="action-btn info">
                        <i class="fa fa-file-text"></i> COA Records
                    </a>
                    <a href="<?=base_url('AdminController/DHR_Report');?>" class="action-btn warning">
                        <i class="fa fa-bar-chart"></i> DHR Reports
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Workflow Process Overview -->
    <div class="row">
        <div class="col-12">
            <div class="stage-workflow">
                <h3><i class="fa fa-sitemap"></i> Device History Record Workflow</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="workflow-step stage-1" onclick="window.location='<?=base_url('AdminController/StageOneOrdersList');?>'">
                            <div class="workflow-icon stage-1">
                                <i class="fa fa-play"></i>
                            </div>
                            <div class="workflow-content">
                                <h5>Stage 1 - Initial Processing</h5>
                                <p>Device setup and initial configuration</p>
                            </div>
                            <div class="workflow-count"><?php echo $stage_counts[1]; ?></div>
                        </div>
                        
                        <div class="workflow-step stage-2" onclick="window.location='<?=base_url('AdminController/StageTwoOrdersList');?>'">
                            <div class="workflow-icon stage-2">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="workflow-content">
                                <h5>Stage 2 - Quality Control</h5>
                                <p>Quality assurance and testing phase</p>
                            </div>
                            <div class="workflow-count"><?php echo $stage_counts[2]; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="workflow-step stage-3" onclick="window.location='<?=base_url('AdminController/StageThreeOrdersList');?>'">
                            <div class="workflow-icon stage-3">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <div class="workflow-content">
                                <h5>Stage 3 - Advanced Processing</h5>
                                <p>Advanced configuration and optimization</p>
                            </div>
                            <div class="workflow-count"><?php echo $stage_counts[3]; ?></div>
                        </div>
                        
                        <div class="workflow-step stage-4" onclick="window.location='<?=base_url('AdminController/StageFourOrdersList');?>'">
                            <div class="workflow-icon stage-4">
                                <i class="fa fa-flag-checkered"></i>
                            </div>
                            <div class="workflow-content">
                                <h5>Stage 4 - Final Approval</h5>
                                <p>Final review and deployment ready</p>
                            </div>
                            <div class="workflow-count"><?php echo $stage_counts[4]; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
  

  
