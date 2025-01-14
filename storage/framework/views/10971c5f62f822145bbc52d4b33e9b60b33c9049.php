<style>
    .nk-menu-sub .nk-menu-link {
        padding: 0.625rem 40px 0.625rem 30px;
        color: #6e82a5;
        font-family: Nunito, sans-serif;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.01em;
        text-transform: none;
        line-height: 1.25rem;
    }
</style>

<div class="nk-aside toggle-screen-lg" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg"
    data-toggle-body="true">
    <div class="nk-sidebar-menu" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px 0px -40px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px 0px 40px;">
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title">Menu</h6>
                                </li>                      
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('dashboard')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('users/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('loan_requests/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                                        <span class="nk-menu-text">Loan Request</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('loan_limit_requests/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                                        <span class="nk-menu-text">Loan Limit Request</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('payments/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-report-profit"></em></span>
                                        <span class="nk-menu-text">Payment History</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('credit_report_transactions/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-report-profit"></em></span>
                                        <span class="nk-menu-text">Credit Report Transaction</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('business_loan_enquiry/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                                        <span class="nk-menu-text">Business Loan Enquiry</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo e(url('business_enquiry_statistics/all')); ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                                        <span class="nk-menu-text">Business Enquiry Statistics</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                        <span class="nk-menu-text">Setting</span>
                                    </a>
                                    <ul class="nk-menu-sub" style="display: none">
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('banners/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-img"></em></span>
                                                <span class="nk-menu-text">Banner</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('partners/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                                <span class="nk-menu-text">Partner</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('notifications/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-bell"></em></span>
                                                <span class="nk-menu-text">Notification</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('notifications/auto_notifications')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-notify"></em></span>
                                                <span class="nk-menu-text">Auto Notification</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('user_notifications/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                                <span class="nk-menu-text">User Notification</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('defaulters_users/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-user-circle"></em></span>
                                                <span class="nk-menu-text">Defaulter User</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('contact_us/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-call-alt"></em></span>
                                                <span class="nk-menu-text">Contact Us</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('loan_stages/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                                <span class="nk-menu-text">Loan Stage</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('user_feedbacks/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-chat"></em></span>
                                                <span class="nk-menu-text">Feedback</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('nbfc/all')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                                <span class="nk-menu-text">NBFC</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?php echo e(url('general_settings/edit/1')); ?>" class="nk-menu-link">
                                                <span class="nk-menu-icon"><em class="icon ni ni-edit"></em></span>
                                                <span class="nk-menu-text">General Setting</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 889px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
        </div>
    </div>
    <div class="nk-aside-close">
        <a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
    </div>
</div>
<?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>