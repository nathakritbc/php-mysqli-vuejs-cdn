     <!-- Modal -->
     <div class="modal fade" id="showDataModal" aria-hidden="false" tabindex="-1" aria-labelledby="showDataModalLabel"
         data-keyboard="false">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="showDataModalLabel">{{showObj.id}}. {{showObj.title}}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeDialog">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body text-secondary">
                     {{showObj.body}}
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary btn-light text-secondary"
                         data-bs-dismiss="modal">ปิด</button>
                     <!-- <button type="button" class="btn btn-danger">ลบ</button> -->
                 </div>
             </div>
         </div>
     </div>