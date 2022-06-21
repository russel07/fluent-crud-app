<template>
  <author-list :authors="filteredAuthors" @add-form="showAddForm"  @search="doSearch"></author-list>
</template>

<script>
import {computed, ref, inject} from "vue";

  import AuthorList from './AuthorList.vue'
  export default {
    name: 'Authors',
    components: {
      AuthorList
    },
    props: [""],
    emits: [""],
    setup(_, context){
      const $rest = inject('$rest');
      const Authors = ref([]);
      const search = ref('');
      const centerDialogVisible = ref(false);
      const showEditDialog = ref(false);

      //Load all authors
      (function(){
        $rest.get(`authors/`, {})
            .then(response => {
              Authors.value = response;
            })
            .catch((errors) => {
              Rest.handleError(errors);
            })
            .always(() => {
              console.log("ajax call done");
            })
      })();

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

      const doSearch = function(query){
        search.value = query;
      }

      return {
        Authors,
        filteredAuthors,
        showAddForm,
        showEditForm,
        doSearch
      }
    }
  }
</script>
