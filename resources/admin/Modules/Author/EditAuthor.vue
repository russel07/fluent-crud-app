<template>
  <el-dialog v-model="showEditDialog" title="Edit Author" width="60%" center>
    <el-card>
      <el-row>
        <el-col class="box-card">

          <el-form ref="form" :model="authorEditForm.author" label-width="120px">
            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>First Name: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="first_name" v-model="authorEditForm.author.first_name" type="string"
                          placeholder="Author First Name"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Last Name: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="last_name" v-model="authorEditForm.author.last_name" type="string"
                          placeholder="Author Last Name"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Contact No: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="contact_no" v-model="authorEditForm.author.contact_no" type="string"
                          placeholder="Author Contact No"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Address: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="contact_no" v-model="authorEditForm.author.address" :rows="2"
                          type="textarea" placeholder="Enter Author address"></el-input>
              </el-col>
            </el-row>
            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Status: </label>
              </el-col>
              <el-col :span="10">
                <el-select id="status" v-model="authorEditForm.author.status" placeholder="Select Status">
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
        <el-button type="primary" @click="updateAuthor">Update</el-button>
        <el-button type="danger" @click="cancelForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {computed, inject} from "vue";
  export default {
    name: 'EditAuthor',
    components: {

    },
    props: ["showEditDialog", "author"],
    emits: ["authors", "edit-dialog"],
    setup(props, context){
      const $rest = inject('$rest');

      const authorEditForm = computed(() => {
        return {
          author: props.author
        }
      });

      const updateAuthor = ()=> {
        $rest.put(`authors/`+authorEditForm.value.author.id, authorEditForm.value.author)
            .then(response => {
              context.emit("authors");
            })
            .catch((errors) => {
              $rest.handleError(errors);
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
        authorEditForm,
        updateAuthor,
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
