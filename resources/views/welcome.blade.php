<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba de solati</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="mt-5 mb-5">
    <div class="container p-5" style="background: #ccc">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center p-5">Task Manager</h1>

                <form id="task-form">
                    @csrf
                    <input type="hidden" id="task-id" name="id" value="">
                    <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion:</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado:</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Guardar Task</button>
                </form>

                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-hover table-responsive mt-4" id="tasks-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tasks-table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    const taskForm = document.getElementById('task-form');
    const tasksTableBody = document.getElementById('tasks-table-body');

    const getTasks = async () => {
        const response = await axios.get('/api/tasks');
        const tasks = response.data;

        tasksTableBody.innerHTML = '';

        tasks.forEach(task => {
            tasksTableBody.innerHTML += `
                <tr>
                    <td>${task.id}</td>
                    <td>${task.titulo}</td>
                    <td>${task.descripcion}</td>
                    <td>${task.estado}</td>
                    <td>
                        <div style="display: flex; gap: 0.2rem;">
                            <button class="btn btn-warning btn-sm" onclick="editTask(${task.id})">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    const saveTask = async (event) => {
        event.preventDefault();

        const task = {
            id: document.getElementById('task-id').value,
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            status: document.getElementById('status').value
        };

        if (task.id) {
            try {
                await axios.put(`/api/tasks/${task.id}`, task);
            } catch (error) {
                alert('Error al actualizar la tarea');
            }
        } else {
            try {
                response = await axios.post('/api/tasks', task);
            } catch (error) {
                alert('Error al guardar la tarea');
            }
        }

        taskForm.reset();
        getTasks();
    }

    const editTask = async (id) => {
        const response = await axios.get(`/api/tasks/${id}`);

        const task = response.data;

        document.getElementById('task-id').value = task.id;
        document.getElementById('title').value = task.titulo;
        document.getElementById('description').value = task.descripcion;
        document.getElementById('status').value = task.estado;
    }

    const deleteTask = async (id) => {
        await axios.delete(`/api/tasks/${id}`);
        getTasks();
    }

    taskForm.addEventListener('submit', saveTask);

    getTasks();
</script>

</html>
