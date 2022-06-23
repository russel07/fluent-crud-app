<template>
  <add-book :showDialog="centerDialogVisible" @show-dialog="showAddForm" @books="loadBooks"></add-book>
  <book-list :books="filteredBooks" @books="loadBooks" @add-form="showAddForm" @existing-author="setExistingBook"  @search="doSearch"></book-list>
</template>

<script>
import {computed, ref, inject} from "vue";
import BookList from "./BookList";
import AddBook from "./AddBook";

  export default {
    name: 'Books',
    components: {
      AddBook,
      BookList

    },
    setup(_, context){
      const $rest = inject('$rest');
      const books = ref([]);
      const search = ref('');
      const centerDialogVisible = ref(false);
      const showEditDialog = ref(false);
      const editForm = ref(false);
      const ExistingBook = ref({});

      const loadBooks = ()=> {
        $rest.get(`books/`, {})
            .then(response => {
              books.value = response;
              console.log(books.value);
            })
            .catch((errors) => {
              Rest.handleError(errors);
            })
            .always(() => {

            })
      }

      //Load all books
      loadBooks();

      //Filter books using search value
      const filteredBooks = computed(function(){
        return books.value.filter(
            (data) => !search.value || data.book_title.toLowerCase().includes(search.value.toLowerCase())
        )
      })

      const showAddForm = function (val) {
        showEditDialog.value = false;
        centerDialogVisible.value = val;
      }
      const showEditForm = function (val) {
        centerDialogVisible.value = false;
        showEditDialog.value = val;
      }

      const setExistingBook = (row) => {
        editForm.value = true;
        centerDialogVisible.value = false;
        showEditDialog.value = true;
        ExistingBook.value = row;
      }

      const doSearch = function(query){
        search.value = query;
      }

      return {
        books,
        filteredBooks,
        centerDialogVisible,
        loadBooks,
        showAddForm,
        editForm,
        showEditForm,
        showEditDialog,
        setExistingBook,
        ExistingBook,
        doSearch
      }
    }
  }
</script>
