<template>
  <el-row>
    <el-col :span="24">
      <el-card class="box-card">
        <template #header>
          <div class="card-header">
            <el-col :md="18"><span>Books</span></el-col>
            <el-col :md="6">
              <el-button class="text-right" size="mini" type="default" @click="showAddForm">Add New</el-button>
            </el-col>
          </div>
        </template>
        <el-table
            :data="books"
            style="width: 100%"
        >
          <el-table-column type="expand">
            <template #default="props">
              <p><b>Author Name: </b>
                <router-link :to="{name: 'author', params: { id: props.row.author.id }}" tag="span">
                  {{props.row.author.first_name}} {{props.row.author.last_name}}
                </router-link></p>

              <p><b>Author Contact: </b>{{props.row.author.contact_no}}</p>
              <p><b>Author Address: </b>{{props.row.author.address}}</p>
            </template>
          </el-table-column>
          <el-table-column label="Book Title" prop="book_title" />
          <el-table-column label="Book Type" prop="book_type" />
          <el-table-column label="Book Description" prop="book_description" />
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
                  @confirm="deleteBook(scope.row.id)"
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
  name: 'BookList',
  components: {
  },
  props: ["books"],
  emits: ["books", "add-form", "existing-book", "search", "delete-book"],
  setup(_, context){
    const $rest = inject('$rest');
    const search = ref('');

    const showAddForm = function (){console.log("clicked");
      context.emit("add-form", true);
    }

    const editForm = function (row){
      context.emit("existing-book", row);
    }

    watch(search, (val) => {
      if(val !== ''){
        context.emit("search", val);
      }else context.emit("search", false);
    })

    const deleteBook = (id)=> {
      $rest.delete(`books/`+id, {})
          .then(response => {
            context.emit("books");
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
      deleteBook
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
