import Sortable from 'sortablejs';
import $ from 'jquery';
document.addEventListener('DOMContentLoaded', function () {
    // Initialize sortablejs on priority groups
    var priorityGroups = document.querySelectorAll('.priority-group');

    priorityGroups.forEach(function (group) {
        new Sortable(group.querySelector('.sortable-tasks'), {
            group: 'priority',
            animation: 150,
            onEnd: function (event) {
                // Update the priority of the task after drag and drop
                var task = event.item;
                var newPriority = task.closest('.priority-group').dataset.priority;
                var projectId = task.closest('.priority-group').dataset.project;
                var taskId = task.closest('.task').dataset.task;

                // console.log(newPriority);
                // console.log(taskId);
                // console.log(projectId);


                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Update the priority using jQuery AJAX
                $.ajax({
                    url: '/projects/' + projectId + '/tasks/' + taskId,
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        priority: newPriority
                    },
                    success: function (response) {
                        console.log('Task priority updated successfully');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating task priority:', error);
                    }
                });
            }
        });
    });
});


$(document).ready(function () {
    // Add event listener for change event on project filter dropdown
    $('#project_filter').change(function () {
        var projectId = $(this).val();
        console.log(projectId);
        // Show all table rows initially
        $('tbody tr').show();

        // Filter table rows based on the selected project ID
        if (projectId) {
            $('tbody tr').each(function () {
                var rowProjectId = $(this).data('project-id');

                if (rowProjectId != projectId) {
                    $(this).hide();
                }
            });
        }
    });
});
