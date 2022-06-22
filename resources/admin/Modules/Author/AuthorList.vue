<template>
  <el-row>
    <el-col :span="16" :offset="4">
      <el-card class="box-card">
        <template #header>
          <div class="card-header">
            <el-col :md="18"><span>Authors</span></el-col>
            <el-col :md="6">
              <el-button class="text-right" size="mini" type="default" @click="showAddForm">Add New</el-button>
            </el-col>
          </div>
        </template>
        <el-table
            :data="authors"
            style="width: 100%"
        >
          <el-table-column label="First Name" prop="first_name" />
          <el-table-column label="Last Name" prop="last_name" />
          <el-table-column label="Contact No" prop="contact_no" />
          <el-table-column label="Address" prop="address" />
          <el-table-column label="Status" prop="status" />
          <el-table-column align="right" width="180">
            <template #header>
              <el-input v-model="search" size="mini" placeholder="Type to search" />
            </template>
            <template #default="scope">

              <el-button size="mini" type="warning" @click="editForm(scope.row)">Edit</el-button>

              <el-popconfirm
                  confirm-button-text="OK"
                  cancel-button-text="No, Thanks"
                  icon="el-icon-info"
                  icon-color="red"
                  title="Are you sure to delete this?"
                  @confirm="deleteAuthor(scope.row.id)"
              >
                <template #reference>
                  <el-button
                      size="mini"
                      type="danger">Delete</el-button>
                </template>
              </el-popconfirm>

            </template>
          </el-table-column>
        </el-table>
      </el-card>
    </el-col>
  </el-row>

</template>
<script>
import {watch, ref, inject} from "vue";

export default {
  name: 'AuthorList',
  components: {
  },
  props: ["authors"],
  emits: ["authors", "add-form", "existing-author", "search", "delete-author"],
  setup(_, context){
    const $rest = inject('$rest');
    const search = ref('');

    const showAddForm = function (){
      context.emit("add-form", true);
    }

    const editForm = function (row){
      context.emit("existing-author", row);
    }

    watch(search, (val) => {
      if(val !== ''){
        context.emit("search", val);
      }else context.emit("search", false);
    })

    const deleteAuthor = (id)=> {
      $rest.delete(`authors/`+id, {})
          .then(response => {
            context.emit("authors");
          })
          .catch((errors) => {
            $rest.handleError(errors);
          })
          .always(() => {
            $rest.loading = false;
          })
    }

    return {
      search,
      showAddForm,
      editForm,
      deleteAuthor
    }
  }
}
</script>

<style>
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>
