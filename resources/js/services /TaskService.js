import axios from "../plugins/axios.js";

class TaskService {
    async create(task) {
        return await axios.post('tasks/create', {title: task.name, description: task.description})
            .then(response => response.data)
    }

    async update(task) {
        return await axios.post(`tasks/edit/${task.id}`, {
            title: task.name,
            description: task.description,
            status: task.status
        })
            .then(response => response.data)
    }

    async toggleConfirm(task, complete) {
        return await axios.post(`tasks/${task}/complete`, {complete})
            .then(response => response.data)
    }

    async getTasks() {
        return await axios.get('tasks/tasks')
            .then(response => response.data)
    }

    async getTasksPage(page = 1) {
        return await axios
            .get('tasks/tasks', {params: {page}})
            .then(response => response.data)
    }
}

export default new TaskService()
