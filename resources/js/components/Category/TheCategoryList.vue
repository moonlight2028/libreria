<template>
  <section class="category-section my-4">
    <div class="card shadow-lg">
      <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <h2 class="mb-0">Categorías</h2>
        <button class="btn btn-light" @click="createCategory">Crear Categoría</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="category_table">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody @click="handleAction"></tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-if="load_modal" class="modal-backdrop">
      <h1>Hola Mundo</h1>
    </div>
  </section>
</template>

<script>
import { ref, onMounted } from 'vue'
import { successMessage, handlerErrors, deleteMessage } from '@/helpers/Alerts.js'

export default {
  setup() {
    const load_modal = ref(false)
    const table = ref(null)
    const category = ref(null)
    onMounted(() => mounteTable())

    const mounteTable = () => {
      table.value = $('#category_table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        scrollX: true,
        order: [[0, 'asc']],
        autoWidth: false,
        dom: 'Bfrtip',
        buttons: ['pageLength', 'excel', 'pdf', 'copy'],
        ajax: `/categories/get-all-dt`,
        columns: [
          { data: 'name', name: 'name', orderable: true, searchable: true },
          {
            name: 'action',
            orderable: false,
            searchable: false,
            render: (data, type, row, meta) => {
              return `<div class="d-flex justify-content-center" data-role='actions'>
                <button onclick='event.preventDefault();' data-id='${row.id}' role='edit' class="btn btn-warning btn-sm">
                  <i class='fas fa-pencil-alt' data-id='${row.id}' role='edit'></i>
                </button>
                <button onclick='event.preventDefault();' data-id='${row.id}' role='delete' class="btn btn-danger btn-sm ms-1">
                  <i class='fas fa-trash-alt' data-id='${row.id}' role='delete'></i>
                </button>
              </div>`
            }
          }
        ]
      })
    }

    const createCategory = () => {
      load_modal.value = true
    }

    const editCategory = async (id) => {
      try {
        const { data } = await axios.get(`/categories/${id}`)
        category.value = data.category
      } catch (error) {
        await handlerErrors(error)
      }
    }

    const deleteCategory = async (id) => {
      if (!await deleteMessage()) return
      try {
        await axios.delete(`/categories/${id}`)
        await successMessage({ is_delete: true })
      } catch (error) {
        await handlerErrors(error)
      }
    }

    const handleAction = (event) => {
      const button = event.target
      const category_id = button.getAttribute('data-id')

      if (button.getAttribute('role') == 'edit') {
        editCategory(category_id)
      } else if (button.getAttribute('role') == 'delete') {
        deleteCategory(category_id)
      }
    }

    return { handleAction, createCategory, load_modal }
  }
}
</script>

<style scoped>
.category-section {
  padding: 2rem;
  background-color: #f8f9fa;
}
.card-header {
  background-color: #007bff;
}
.card-body {
  background-color: #ffffff;
}
.table-hover tbody tr:hover {
  background-color: #f1f1f1;
}
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
