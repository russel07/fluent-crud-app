<template>
  <el-dialog v-model="showEditDialog" title="Edit Book" width="60%" center>
    <el-card>
      <el-row>
        <el-col class="box-card">

          <el-form ref="form" :model="bookEditForm.book" label-width="120px">
            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Title: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_title" v-model="bookEditForm.book.book_title" type="string"
                          placeholder="Book Title"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Description: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_description" v-model="bookEditForm.book.book_description" :rows="2"
                          type="textarea" placeholder="Book Description"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Type: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_type" v-model="bookEditForm.book.book_type" type="string"
                          placeholder="Book Type"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Author: </label>
              </el-col>
              <el-col :span="10">
                <el-select id="author_id" v-model="bookEditForm.book.author_id"
                           filterable
                           remote
                           placeholder="Select Author"
                           :remote-method="getAuthor"
                           :loading="loading">
                  <el-option
                      v-for="item in authors"
                      :key="item.id"
                      :label="item.full_name"
                      :value="item.id"
                  />
                </el-select>
              </el-col>

            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Status: </label>
              </el-col>
              <el-col :span="10">
                <el-select id="status" v-model="bookEditForm.book.status" placeholder="Select Status">
                  <el-option label="Active" value="Active"></el-option>
                  <el-option label="Inactive" value="Inactive"></el-option>
                </el-select>
              </el-col>
            </el-row>
          </el-form>
        </el-col>
      </el-row>
    </el-card>
    <template #footer>
      <span class="dialog-footer">
        <el-button type="primary" @click="updateBook">Update</el-button>
        <el-button type="danger" @click="cancelForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {inject, ref, computed} from "vue";
  export default {
    name: 'EditBook',
    components: {

    },
    props: ["showEditDialog", "book"],
    emits: ["books", "edit-dialog"],
    setup(props, context){
      const authors = ref([]);
      const $rest = inject('$rest');
      const alert = inject('alert');
      const { success } = alert();
      const $handleError = inject('$handleError');

      const bookEditForm = computed(() => {
        return {
          book: props.book
        }
      });

      const getAuthor = (query) => {
        if (query) {
          $rest.get(`authors/search/${query}`, {})
              .then(response => {
                authors.value = response;
              })
              .catch((errors) => {

              })
              .always(() => {

              })
        } else {
          authors.value = []
        }
      }

      const updateBook = ()=> {
        $rest.put(`books/`+bookEditForm.value.book.id, bookEditForm.value.book)
            .then(response => {
              success(response.message);
              context.emit("books");
            })
            .catch((errors) => {
              $handleError(errors);
            })
            .always(() => {
              context.emit("edit-dialog", false);
              $rest.loading = false;
            })
      }

      const cancelForm = ()=> {
        context.emit("edit-dialog", false);
      }

      return {
        bookEditForm,
        authors,
        getAuthor,
        updateBook,
        cancelForm
      }
    }
  }
</script>

<style>
.el-row{
    margin-bottom: 2%;
  }
</style>
