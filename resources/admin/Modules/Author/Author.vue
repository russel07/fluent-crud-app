<template>
  <el-breadcrumb separator="/">
    <el-breadcrumb-item :to="{ path: '/authors' }">Authors</el-breadcrumb-item>
    <el-breadcrumb-item>{{author.full_name}} </el-breadcrumb-item>
  </el-breadcrumb>

  <el-card class="box-card" v-if="!notReady">
    <template #header>
      <div class="card-header">
        <span>Author Details</span>
      </div>
    </template>
    <div class="text item">
      <span><b>First Name: </b>{{author.first_name}}</span>
    </div>
    <div class="text item">
      <span><b>Last Name: </b>{{author.last_name}}</span>
    </div>
    <div class="text item">
      <span><b>Contact No: </b>{{author.contact_no}}</span>
    </div>

    <div class="text item">
      <span><b>Address: </b>{{author.address}}</span>
    </div>

    <hr/>
    <h3>Books by This Author</h3>
    <hr/>

    <div class="text item" v-for="(book, ind) in author.books">
      <ul>
        <li><span><b>Title: </b>
        <router-link :to="{name: 'book', params: { id: book.id }}" tag="span">
                  {{book.book_title}}
                </router-link>
        </span></li>
        <li><span><b>Type: </b>{{book.book_type}}</span></li>
      </ul>

    </div>
  </el-card>
</template>

<script>
import {inject, ref} from "vue";
import { useRoute } from 'vue-router'
export default {
    name: 'Author',
    setup(_, context){
      const $rest = inject('$rest');
      const author = ref({});
      const notReady = ref(true);
      const route = useRoute()

      const loadAuthor = ()=> {
        let id = route.params.id;
        $rest.get(`authors/${id}`, {})
            .then(response => {
              author.value = response;
              console.log(author.value);
              notReady.value = false;
            })
            .catch((errors) => {
              Rest.handleError(errors);
            })
            .always(() => {

            })
      }

      loadAuthor();

      return{
        author,
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
