     <!-- Modal -->
     <div class="modal fade " ref="modalDelete" class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="deleteModalLabel">ต้องการลบข้อมูลหรือไม่</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     {{showObj.title}}
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="text-secondary btn btn-secondary btn-light" data-dismiss="modal"
                         aria-label="Close">ปิด</button>
                     <button type="button" class="btn btn-danger" @click="deleteItem(showObj.id)">ลบ</button>
                 </div>
             </div>
         </div>
     </div>