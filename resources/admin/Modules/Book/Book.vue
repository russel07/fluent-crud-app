<template>
  <el-breadcrumb separator="/">
    <el-breadcrumb-item :to="{ path: '/books' }">Books</el-breadcrumb-item>
    <el-breadcrumb-item>{{book.book_title}} </el-breadcrumb-item>
  </el-breadcrumb>

  <el-card class="box-card" v-if="!notReady">
    <template #header>
      <div class="card-header">
        <span>Book Details</span>
      </div>
    </template>
    <div class="text item">
      <span><b>Title: </b>{{book.book_title}}</span>
    </div>
    <div class="text item">
      <span><b>Description: </b>{{book.book_description}}</span>
    </div>
    <div class="text item">
      <span><b>Type: </b>{{book.book_type}}</span>
    </div>

    <hr/>
    <h3>Author Information</h3>
    <hr/>

    <div class="text item">
      <span><b>Author Name: </b>{{book.author.first_name}} {{book.author.last_name}}</span>
    </div>
    <div class="text item">
      <span><b>Author Contact: </b>{{book.author.contact_no}}</span>
    </div>

    <div class="text item">
      <span><b>Author Address: </b>{{book.author.address}}</span>
    </div>
  </el-card>
</template>

<script>
import {inject, ref} from "vue";
import { useRoute } from 'vue-router'
export default {
    name: 'viewBook',
    setup(_, context){
      const $rest = inject('$rest');
      const book = ref({});
      const notReady = ref(true);
      const route = useRoute()

      const loadBook = ()=> {
        let id = route.params.id;
        $rest.get(`books/${id}`, {})
            .then(response => {
              book.value = response;
              notReady.value = false;
            })
            .catch((errors) => {
              Rest.handleError(errors);
            })
            .always(() => {

            })
      }

      loadBook();

      return{
        book,
        notReady
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

.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}

.el-breadcrumb{
  margin-bottom: 2%;
  background: #fafafa;
  padding: 2%;
}
.el-breadcrumb__inner.is-link, .el-breadcrumb__inner a{
  color:blueviolet!important;
}
</style>
