<template>
  <add-author  :showDialog="centerDialogVisible" @show-dialog="showAddForm" @authors="loadAuthors"></add-author>
  <edit-author @shv-if="editForm" :showEditDialog="showEditDialog" :author="ExistingAuthor" @edit-dialog="showEditForm"></edit-author>
  <author-list :authors="filteredAuthors" @authors="loadAuthors" @add-form="showAddForm" @existing-author="setExistingAuthor"  @search="doSearch"></author-list>
</template>

<script>
import {computed, ref, inject} from "vue";

import AuthorList from './AuthorList.vue'
import AddAuthor from "./AddAuthor";
import EditAuthor from "./EditAuthor";

  export default {
    name: 'Authors',
    components: {
      EditAuthor,
      AddAuthor,
      AuthorList
    },
    setup(_, context){
      const $rest = inject('$rest');
      const Authors = ref([]);
      const search = ref('');
      const centerDialogVisible = ref(false);
      const showEditDialog = ref(false);
      const editForm = ref(false);
      const ExistingAuthor = ref({});

      const loadAuthors = ()=> {
        $rest.get(`authors/`, {})
            .then(response => {
              Authors.value = response;
              console.log(Authors.value);
            })
            .catch((errors) => {
              Rest.handleError(errors);
            })
            .always(() => {

            })
      }

      //Load all authors
      loadAuthors();

      //Filter authors using search value
      const filteredAuthors = computed(function(){
        return Authors.value.filter(
            (data) => !search.value || data.first_name.toLowerCase().includes(search.value.toLowerCase())
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

      const setExistingAuthor = (row) => {
        editForm.value = true;
        centerDialogVisible.value = false;
        showEditDialog.value = true;
        ExistingAuthor.value = row;
      }

      const doSearch = function(query){
        search.value = query;
      }

      return {
        Authors,
        filteredAuthors,
        centerDialogVisible,
        loadAuthors,
        showAddForm,
        editForm,
        showEditForm,
        showEditDialog,
        setExistingAuthor,
        ExistingAuthor,
        doSearch
      }
    }
  }
</script>
