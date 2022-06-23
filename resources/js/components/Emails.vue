<template>
    <div class="emails">
        <h4>All Emails</h4>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Title</th>
                <th>Status</th>
                <th>Position</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>1</td>
                <td>
                    <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <p class="fw-bold mb-1">John Doe</p>
                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                    </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">Software engineer</p>
                    <p class="text-muted mb-0">IT department</p>
                </td>
                <td>
                    <span class="badge badge-success rounded-pill d-inline">Active</span>
                </td>
                <td>Senior</td>
                <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                    </button>
                </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
