@extends('admin.layout.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap5.min.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"><span>Live Match</span></li>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong>Live Match Management</strong>
                                <div>
                                    <button type="button" class="btn btn-info me-2" id="statisticsButton" onclick="loadStatistics()">
                                        <i class="fa fa-chart-bar"></i> Statistics
                                    </button>
                                    <a href="{{ route('admin.live-match.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Create Live Match
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-listing table-responsive">
                                <table class="table live-match-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Match Title</th>
                                            <th>OBS Status</th>
                                            <th>Viewers</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Statistics Modal -->
    <!-- Statistics Modal -->
    <div class="modal fade" id="statisticsModal" tabindex="-1" aria-labelledby="statisticsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statisticsModalLabel">Streaming Statistics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeStatisticsModal"></button>
                </div>
                <div class="modal-body" id="statisticsContent">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeStatisticsModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.live-match-table').DataTable({
                bSort: true,
                processing: true,
                autoWidth: false,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{!! route('admin.live-match.index') !!}",
                    data: function(d) {
                        var form = {};
                        $.each($('#form').serializeArray(), function() {
                            form[this.name] = this.value;
                        });
                        d.form_data = form;
                    },
                },
                columns: [{
                        data: 'match_title',
                        name: 'match_title',
                        width: '25%'
                    },
                    {
                        data: 'obs_status_badge',
                        name: 'obs_status_badge',
                        width: '15%'
                    },
                    {
                        data: 'viewer_count',
                        name: 'viewer_count',
                        width: '10%'
                    },
                    {
                        data: 'stream_duration',
                        name: 'stream_duration',
                        width: '15%'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: '10%'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: '15%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false,
                        width: '20%'
                    }
                ]
            });

            // Delete functionality
            $('table tbody').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action is not able to be reverted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.delete(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Record deleted successfully!',
                            icon: 'success',
                        });
                        table.ajax.reload();
                    }
                });
            });

            // Status toggle functionality
            $('table tbody').on('click', '.btn-status', function() {
                var url = $(this).data("url");
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will change the live match status.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: "btn btn-success me-2",
                        cancelButton: "btn btn-danger ms-2"
                    },
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    preConfirm: (response) => {
                        if (response) {
                            return axios.post(url, {})
                                .then(() => {
                                    table.ajax.reload();
                                })
                                .catch((e) => {
                                    console.error("error ", e)
                                    Swal.showValidationMessage(
                                        `Request failed: ${e}`
                                    );
                                })
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Updated!',
                            text: 'Status updated successfully!',
                            icon: 'success',
                        });
                        table.ajax.reload();
                    }
                });
            });

            // Streaming control functions
            $('table tbody').on('click', '.btn-start-streaming', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                performStreamingAction(url, 'start streaming', table);
            });

            $('table tbody').on('click', '.btn-mark-live', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                performStreamingAction(url, 'mark as live', table);
            });

            $('table tbody').on('click', '.btn-stop-streaming', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                performStreamingAction(url, 'stop streaming', table);
            });
        });

        function performStreamingAction(url, action, table) {
            Swal.fire({
                title: `Are you sure?`,
                text: `This will ${action} for this live match.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Yes, ${action}!`,
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: "btn btn-success me-2",
                    cancelButton: "btn btn-danger ms-2"
                },
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                preConfirm: (response) => {
                    if (response) {
                        return axios.post(url, {})
                            .then((response) => {
                                if (response.data.success) {
                                    table.ajax.reload();
                                    return response.data;
                                } else {
                                    throw new Error(response.data.message || 'Unknown error');
                                }
                            })
                            .catch((e) => {
                                console.error("error ", e);
                                Swal.showValidationMessage(
                                    `Request failed: ${e.response?.data?.message || e.message}`
                                );
                            })
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Success!',
                        text: result.value.message || `Action completed successfully!`,
                        icon: 'success',
                    });
                    table.ajax.reload();
                }
            });
        }

        function loadStatistics() {
            console.log('📊 Loading statistics...');
            
            // Check if axios is available
            if (typeof axios === 'undefined') {
                console.error('❌ Axios is not loaded!');
                alert('Error: Axios library is not loaded. Please refresh the page.');
                return;
            }
            
            // Check if bootstrap is available
            if (typeof bootstrap === 'undefined') {
                console.error('❌ Bootstrap is not loaded!');
                alert('Error: Bootstrap library is not loaded. Please refresh the page.');
                return;
            }
            
            const modalElement = document.getElementById('statisticsModal');
            if (!modalElement) {
                console.error('❌ Modal element not found!');
                alert('Error: Statistics modal not found.');
                return;
            }
            
            // Create modal without backdrop
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: false,  // No backdrop overlay
                keyboard: true    // ESC key can still close
            });
            
            // Store modal instance globally for manual closing
            window.currentStatisticsModal = modal;
            
            modal.show();
            console.log('✅ Modal opened (no backdrop)');
            
            const url = "{{ route('admin.live-match.statistics') }}";
            console.log('🔗 Fetching from:', url);
            
            axios.get(url)
                .then(response => {
                    console.log('✅ Response received:', response.data);
                    
                    if (response.data.success && response.data.data) {
                        const stats = response.data.data;
                        const content = `
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body text-center">
                                            <h4>${stats.total_matches}</h4>
                                            <p class="mb-0">Total Matches</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="card bg-danger text-white">
                                        <div class="card-body text-center">
                                            <h4>${stats.live_matches}</h4>
                                            <p class="mb-0">Live Now</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h4>${stats.total_viewers.toLocaleString()}</h4>
                                            <p class="mb-0">Total Viewers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body text-center">
                                            <h4>${stats.average_viewers}</h4>
                                            <p class="mb-0">Avg Viewers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('statisticsContent').innerHTML = content;
                        console.log('✅ Statistics displayed successfully');
                    } else {
                        console.warn('⚠️ Invalid response format:', response.data);
                        document.getElementById('statisticsContent').innerHTML = 
                            '<div class="alert alert-warning">No statistics data available</div>';
                    }
                })
                .catch(error => {
                    console.error('❌ Error loading statistics:', error);
                    let errorMessage = 'Error loading statistics';
                    
                    if (error.response) {
                        console.error('Response status:', error.response.status);
                        console.error('Response data:', error.response.data);
                        errorMessage += ` (Status: ${error.response.status})`;
                    } else if (error.request) {
                        console.error('No response received:', error.request);
                        errorMessage += ' (No response from server)';
                    } else {
                        console.error('Error message:', error.message);
                        errorMessage += ` (${error.message})`;
                    }
                    
                    document.getElementById('statisticsContent').innerHTML = 
                        `<div class="alert alert-danger">${errorMessage}</div>`;
                });
        }
        
        // Function to manually close the modal (fallback)
        function closeStatisticsModal() {
            console.log('🔒 Closing statistics modal...');
            
            if (window.currentStatisticsModal) {
                try {
                    window.currentStatisticsModal.hide();
                    console.log('✅ Modal closed via instance');
                } catch (error) {
                    console.error('❌ Error closing modal via instance:', error);
                    // Fallback: remove modal elements manually
                }
            }
        }
        
        // Setup event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Statistics button
            const btn = document.getElementById('statisticsButton');
            if (btn) {
                console.log('✅ Statistics button found, adding event listener');
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('🖱️ Statistics button clicked via event listener');
                    loadStatistics();
                });
            } else {
                console.warn('⚠️ Statistics button not found');
            }
            
            // Log when modal is closed (for debugging)
            const modalElement = document.getElementById('statisticsModal');
            if (modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    console.log('✅ Modal closed successfully');
                });
            }
        });
    </script>
@endsection
