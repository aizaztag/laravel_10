<template>
    <div>
        <table id="taskTable" class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks" :key="task.id">
                <td>{{ task.id }}</td>
                <td>{{ task.title }}</td>
                <td>{{ task.description }}</td>
                <td>
                    <button @click="editTask(task)">Edit</button>
                    <button @click="deleteTask(task.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    // import 'datatables.net-bs4/js/dataTables.bootstrap4.min.js';
    // import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
    export default {
        data() {
            return {
                tasks: [],
            };
        },
        mounted() {
            this.fetchTasks();
        },
        methods: {
            fetchTasks() {
                axios.get('/api/tasks')
                    .then(response => {
                        this.tasks = response.data;
                        // Initialize DataTable after data is loaded
                        this.initDataTable();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            initDataTable() {
                $(this.$el).find('#taskTable').DataTable();
            },
            editTask(task) {
                // Handle edit task logic
            },
            deleteTask(taskId) {
                axios.delete(`/api/tasks/${taskId}`)
                    .then(() => {
                        this.fetchTasks();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
        },
    };
</script>
