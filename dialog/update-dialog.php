     <!-- Modal -->
     <div class="modal fade" id="updateModal" aria-hidden="false" tabindex="-1" aria-labelledby="updateModalLabel"
         data-backdrop="static">
         <div class="modal-dialog">
             <div class="modal-content">
                 <form method="post" id="updateForm" @submit.prevent="onUpdateSubmit">
                     <div class="modal-header">
                         <h5 class="modal-title" id="createModalLabel">เเก้ไขข้อมูล</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                             @click="closeDialog">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body ">

                         <div class="mb-3">
                             <label class="form-label">Title</label>
                             <input type="text" v-model="formState.title" class="form-control text-secondary "
                                 id="title" name="title" placeholder="Enter title">
                         </div>
                         <div class="mb-3">
                             <label class="form-label">UserId</label>
                             <input type="number" v-model="formState.userId" class="form-control text-secondary"
                                 id="userId" name="userId" placeholder="Enter userId">
                         </div>
                         <div class="mb-3">
                             <label class="form-label">Body</label>
                             <textarea v-model="formState.body" class="form-control text-secondary" id="body"
                                 name="body" placeholder="Enter body" rows="4"></textarea>
                         </div>

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="text-secondary btn btn-secondary btn-light" data-dismiss="modal"
                             aria-label="Close" @click="closeDialog">ปิด</button>
                         <button type="submit" class="btn btn-primary">เเก้ไข</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>