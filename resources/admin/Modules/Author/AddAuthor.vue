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
                <el-input id="first_name" @click="clickedMe" @keyup="isValid" v-model="authorForm.first_name" type="string"
                          placeholder="Author First Name" :class="Errors.first_name ? 'has-error' : ''"></el-input>
              </el-col>
              <el-col v-if="Errors.first_name" :span="8" class="text-align-left p-1 has-error">
                <error-message :message="Errors.first_name"></error-message>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Last Name: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="last_name" @click="clickedMe" @keyup="isValid" v-model="authorForm.last_name" type="string"
                          placeholder="Author Last Name"></el-input>
              </el-col>

              <el-col v-if="Errors.last_name" :span="8" class="text-align-left p-1 has-error">
                <error-message :message="Errors.last_name"></error-message>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Contact No: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="contact_no" @click="clickedMe" @keyup="isValid" v-model="authorForm.contact_no" type="string"
                          placeholder="Author Contact No"></el-input>
              </el-col>

              <el-col v-if="Errors.contact_no" :span="8" class="text-align-left p-1 has-error">
                <error-message :message="Errors.contact_no"></error-message>
              </el-col>
            </el-row>

            <el-row class="input-field">
              <el-col :span="6" class="text-align-right p-1">
                <label>Address: </label>
              </el-col>
              <el-col :span="10">
                <el-input id="address" @click="clickedMe" @keyup="isValid" v-model="authorForm.address" :rows="2"
                          type="textarea" placeholder="Enter Author address"></el-input>
              </el-col>

              <el-col v-if="Errors.address" :span="8" class="text-align-left p-1 has-error">
                <error-message :message="Errors.address"></error-message>
              </el-col>
            </el-row>
          </el-form>
        </el-col>
      </el-row>
    </el-card>
    <template #footer>
      <span class="dialog-footer">
        <el-button type="primary" @click="saveAuthor" :disabled="Errors.first_name !== '' || Errors.last_name !== '' || Errors.contact_no !== '' ||Errors.address !== ''">Save</el-button>
        <el-button type="danger" @click="cancelForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {reactive, inject, ref} from "vue";
import ErrorMessage from "../../Components/ErrorMessage";
  export default {
    name: 'AddAuthor',
    components: {
      ErrorMessage
    },
    props: ["showDialog"],
    emits: ["authors", "show-dialog"],
    setup(props, context){
      const $rest = inject('$rest');
      const alert = inject('alert');
      const HandleErrorMessage = inject('HandleErrorMessage');
      const Errors = ref({
        first_name: '',
        last_name: '',
        contact_no: '',
        address: '',
      });

      const labels = ref({
        first_name: 'First Name',
        last_name: 'Last Name',
        contact_no: 'Contact No',
        address: 'Address',
      });
      const authorForm = reactive({
        first_name: '',
        last_name: '',
        contact_no: '',
        address: '',
      })

      const clicked = {
        first_name: false,
        last_name: false,
        contact_no: false,
        address: false,
      };

      const { success } = alert();
      const { showError } = HandleErrorMessage();

      const clickedMe = (e)=>{
        let id = e.target.getAttribute("id");
        clicked[id] = true;
      }

      const isValid = (e)=>{
        let id = e.target.getAttribute("id");
        let value = e.target.value;

        if(clicked[id]) {
          if (value.trim() === '') {
            Errors.value[id] = labels.value[id]+' can not be blank';
          } else {
            Errors.value[id] = '';
          }
        }
      }

      const saveAuthor = ()=> {
        $rest.post(`authors/`, authorForm)
            .then(response => {
              $rest.loading = false;
              context.emit("show-dialog", false);
              success(response.message);
              context.emit("authors");
            })
            .catch((errors) => {
              showError(errors);
            })
            .always(() => {
            })
      }

      const cancelForm = ()=> {
        context.emit("show-dialog", false);
      }

      return {
        authorForm,
        saveAuthor,
        cancelForm,
        clickedMe,
        isValid,
        Errors
      }
    }
  }
</script>

<style>
.el-row{
    margin-bottom: 2%;
  }
.p-1{
  padding: 1% !important;
}

.input-field{
  margin-bottom: 1%;
}

.has-error span{
  color: #ff0068;
  font-weight: 600;
}

.has-error input, select, textarea{
  border: thin solid #ff0068;
}
</style>
