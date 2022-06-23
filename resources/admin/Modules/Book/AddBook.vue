<template>
  <el-dialog v-model="showDialog" title="Add Book" width="60%" center>
    <el-card>
      <el-row>
        <el-col class="box-card">
          <el-form ref="form" label-width="120px">
            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Title: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_title" v-model="bookForm.book_title" type="string"
                          placeholder="Book Title"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Description: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_description" v-model="bookForm.book_description" :rows="2"
                          type="textarea" placeholder="Book Description"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Type: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="book_type" v-model="bookForm.book_type" type="string"
                          placeholder="Book Type"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Author: </label>
              </el-col>
              <el-col :span="10">
                <el-select id="author_id" v-model="bookForm.author_id"
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
          </el-form>
        </el-col>
      </el-row>
    </el-card>
    <template #footer>
      <span class="dialog-footer">
        <el-button type="primary" @click="saveBook">Save</el-button>
        <el-button type="danger" @click="cancelForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {reactive, inject, ref} from "vue";
  export default {
    name: 'AddBook',
    components: {

    },
    props: ["showDialog"],
    emits: ["books", "show-dialog"],
    setup(props, context){
      const authors = ref([]);
      const $rest = inject('$rest');
      const $handleError = inject('$handleError');
      const bookForm = reactive({
        book_title: '',
        book_description: '',
        book_type: '',
        author_id: '',
      })

      const getAuthor = (query) => {
        if (query) {
          $rest.get(`authors/search/${query}`, {})
              .then(response => {
                authors.value = response;
                console.log(authors.value);
              })
              .catch((errors) => {

              })
              .always(() => {

              })
        } else {
          authors.value = []
        }
      }

      const saveBook = ()=> {
        $rest.post(`books/`, bookForm)
            .then(response => {
              context.emit("books");
            })
            .catch((errors) => {
              $handleError(errors);
            })
            .always(() => {
              context.emit("show-dialog", false);
              $rest.loading = false;
            })
      }

      const cancelForm = ()=> {
        context.emit("show-dialog", false);
      }

      return {
        bookForm,
        authors,
        getAuthor,
        saveBook,
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
