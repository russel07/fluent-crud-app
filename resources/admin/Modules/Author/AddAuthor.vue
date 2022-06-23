<template>
  <el-dialog v-model="showDialog" title="Add Author" width="60%" center>
    <el-card>
      <el-row>
        <el-col class="box-card">
          <el-form ref="form" label-width="120px">
            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>First Name: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="first_name" v-model="authorForm.first_name" type="string"
                          placeholder="Author First Name"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Last Name: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="last_name" v-model="authorForm.last_name" type="string"
                          placeholder="Author Last Name"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Contact No: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="contact_no" v-model="authorForm.contact_no" type="string"
                          placeholder="Author Contact No"></el-input>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Address: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="contact_no" v-model="authorForm.address" :rows="2"
                          type="textarea" placeholder="Enter Author address"></el-input>
              </el-col>
            </el-row>
          </el-form>
        </el-col>
      </el-row>
    </el-card>
    <template #footer>
      <span class="dialog-footer">
        <el-button type="primary" @click="saveAuthor">Save</el-button>
        <el-button type="danger" @click="cancelForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {reactive, inject} from "vue";
  export default {
    name: 'AddAuthor',
    components: {

    },
    props: ["showDialog"],
    emits: ["authors", "show-dialog"],
    setup(props, context){
      const $rest = inject('$rest');
      const alert = inject('alert');
      const $handleError = inject('$handleError');
      const authorForm = reactive({
        first_name: '',
        last_name: '',
        contact_no: '',
        address: '',
      })

      const { success } = alert();

      const saveAuthor = ()=> {
        $rest.post(`authors/`, authorForm)
            .then(response => {
              success(response.message);
              context.emit("authors");
            })
            .catch((errors) => {
              console.log(errors);
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
        authorForm,
        saveAuthor,
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
