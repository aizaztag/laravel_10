<template>
    <div>
        <table id="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'User',
        created() {
            jQuery(document).ready( function ($) {
                $.noConflict();
                $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "api/users",
                    "columns": [
                        { "data": "id" },
                        { "data": "name" },
                        { "data": "email" },
                    ]
                });
            });
        }
    }
</script>
