<template>
  <el-dialog v-model="showDialog" title="Add Author" width="60%" center>
    <el-card>
      <el-form
          ref="ruleFormRef"
          :model="authorForm"
          status-icon
          :rules="rules"
          label-width="120px"
          class="demo-ruleForm"
      >
        <el-form-item label="First Name" prop="pass">
          <el-input v-model="authorForm.first_name" type="text" autocomplete="off" />
        </el-form-item>

        <el-form-item label="Last Name" prop="checkPass">
          <el-input
              v-model="authorForm.last_name"
              type="text"
              autocomplete="off"
          />
        </el-form-item>

        <el-form-item label="Contact No" prop="age">
          <el-input v-model.number="authorForm.contact_no" />
        </el-form-item>

        <el-form-item>
          <el-button type="primary" @click="submitForm(ruleFormRef)"
          >Submit</el-button
          >
          <el-button @click="resetForm(ruleFormRef)">Reset</el-button>
        </el-form-item>

      </el-form>
    </el-card>
    <template #footer>
      <span class="dialog-footer">
        <el-button type="primary" @click="saveTopics">Save</el-button>
        <el-button type="danger" @click="cancleForm">Cancel</el-button>
      </span>
    </template>
  </el-dialog>
</template>

<script>
import {reactive, ref, inject} from "vue";
import { FormInstance } from 'element-plus'
  export default {
    name: 'AddAuthor',
    components: {

    },
    props: ["showDialog"],
    emits: ["authors", "show-dialog"],
    setup(props, context){
      const $rest = inject('$rest');
      const authorForm = reactive({
        first_name: '',
        last_name: '',
        contact_no: '',
        address: '',
      })

      const authorFormRef = ref<FormInstance>();

      return {
        authorForm,
        authorFormRef
      }
    }
  }
</script>
