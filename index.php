 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="Description" content="Enter your description here" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
     <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
     <!-- Option 1: Include in HTML -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <title>PHP MySqli Vuejs</title>
 </head>

 <body>

     <?php include('./db/connectDB.php'); ?>


     <div id="app" class="container my-5">
         <h1 class="text-secondary "><span class="text-primary">PHP</span> <span class="text-danger">MySqli</span> and
             <span class="text-success">Vue</span> CDN <span class="text-primary">Crud</span>
         </h1>
         <div class="d-flex justify-content-end  mt-4 mb-2">
             <button @click="closeDialog" type="button" class="btn btn-primary  " data-toggle="modal"
                 data-target="#createModal"> <i class="fa-solid fa-plus text-white"></i> เพิ่มรายการ</button>
         </div>
         <table class="table">
             <thead>
                 <tr class="bg-secondary text-light">
                     <th scope="col">#</th>
                     <th scope="col">title</th>
                     <th scope="col">Body</th>
                     <th class="text-center" scope="col">Acctions</th>
                 </tr>
             </thead>
             <tbody>
                 <tr v-for="(item,index) in posts" :key="item.id">
                     <th scope="row">{{index + 1}}</th>
                     <td class="text-dark text-capitalize">{{item.title}}</td>
                     <td class="text-secondary">{{item.body}}</td>
                     <td>
                         <div class="d-flex flex-col  align-items-center  justify-content-center">
                             <button type="button" class="btn btn-primary btn-light" data-toggle="modal"
                                 data-target="#showDataModal" @click="openDialog(item)">
                                 <i class="fa-solid fa-eye text-secondary"></i>
                             </button>
                             <button type="button" class="btn btn-warning btn-light" data-toggle="modal"
                                 data-target="#updateModal" @click="formState = item">
                                 <i class="fa-solid fa-pencil text-secondary"></i>
                             </button>

                             <button type="button" class="btn btn-danger btn-light" data-toggle="modal"
                                 data-target="#deleteModal" @click="openDialog(item)">
                                 <i class="fa-solid fa-trash text-secondary"></i>
                             </button>

                         </div>
                     </td>
                 </tr>
             </tbody>
         </table>


         <div class="text-center text-secondary mt-5" v-if="posts.length == 0">
             <h1>Data Emty</h1>
         </div>

         <!-- import create Modal -->
         <?php include('./dialog/create-dialog.php'); ?>
         <!-- import show Modal -->
         <?php include('./dialog/show-dialog.php'); ?>
         <!-- import update Modal -->
         <?php include('./dialog/update-dialog.php'); ?>
         <!-- import delete Modal -->
         <?php include('./dialog/delete-dialog.php'); ?>
     </div>

     <script>
     const {
         createApp,
         ref,
         onMounted
     } = Vue
     createApp({
         setup() {
             const modalDelete = ref(null)
             const posts = ref([])
             const initState = {
                 title: null,
                 userId: null,
                 body: null
             }
             const formState = ref({
                 ...initState
             })
             const showObj = ref({
                 id: 0,
                 title: '',
                 userId: 0,
                 body: ''
             })
             const fetchData = async () => {
                 try {
                     const apiUrl = './api/posts/get-posts.php'
                     const {
                         data,
                     } = await axios.get(apiUrl)
                     posts.value = data
                 } catch (error) {
                     console.error(error);
                 }
             }
             const openDialog = (item) => {
                 showObj.value = item
             }

             const onCreateSubmit = () => {
                 for (const key in formState.value) {
                     if (Object.hasOwnProperty.call(formState.value, key)) {
                         const element = formState.value[key];
                         if (!element) {
                             Swal.fire({
                                 icon: "error",
                                 title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                                 confirmButtonText: "ปิด"
                             })
                             return false
                         }
                     }
                 }
                 //END FOR
                 createData()
             }
             onUpdateSubmit = () => {
                 for (const key in formState.value) {
                     if (Object.hasOwnProperty.call(formState.value, key)) {
                         const element = formState.value[key];
                         if (!element) {
                             Swal.fire({
                                 icon: "error",
                                 title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                                 confirmButtonText: "ปิด"
                             })
                             return false
                         }
                     }
                 }
                 //END FOR
                 updateData()
             }
             const updateData = async () => {
                 try {
                     const apiUrl = `./api/posts/update-posts.php?id=${formState.value.id}`
                     const {
                         data,
                         status
                     } = await axios.put(apiUrl, formState.value)
                     if (status !== 200) {
                         console.error("เกิดข้อผิดพลาดในการเเก้ไขข้อมูล");
                         Swal.fire({
                             icon: "error",
                             title: "เกิดข้อผิดพลาดในการเเก้ไขข้อมูล",
                             confirmButtonText: "ปิด"
                         })
                     }
                     formState.value = initState
                     posts.value[formState.value.id] = data.data
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "เเก้ไขข้อมูลเรียบร้อย",
                         showConfirmButton: false,
                         timer: 1500
                     })
                     $('#updateModal').modal('hide')
                 } catch (error) {
                     console.error(error);
                     Swal.fire({
                         icon: "error",
                         title: "เกิดข้อผิดพลาดในการเเก้ไขข้อมูล",
                         confirmButtonText: "ปิด"
                     })
                 }
             }
             const createData = async () => {
                 try {
                     const apiUrl = './api/posts/create-posts.php'
                     const {
                         data,
                         status
                     } = await axios.post(apiUrl, formState.value)
                     if (status !== 200) {
                         console.error("เกิดข้อผิดพลาดในการบันทึกข้อมูล");
                         Swal.fire({
                             icon: "error",
                             title: "เกิดข้อผิดพลาดในการบันทึกข้อมูล",
                             confirmButtonText: "ปิด"
                         })
                     }
                     formState.value = initState
                     posts.value.unshift(data.data)
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "บันทึกข้อมูลเรียบร้อย",
                         showConfirmButton: false,
                         timer: 1500
                     })
                     $('#createModal').modal('hide')

                 } catch (error) {
                     console.error(error);
                     Swal.fire({
                         icon: "error",
                         title: "เกิดข้อผิดพลาดในการบันทึกข้อมูล",
                         confirmButtonText: "ปิด"
                     })
                 }
             }
             const deleteItem = async (id) => {
                 try {
                     const {
                         data,
                         status
                     } = await axios.delete(`./api/posts/delete-posts.php?id=${id}`)
                     if (status !== 200) {
                         console.error("เกิดข้อผิดพลาดในการลบข้อมูล");
                         Swal.fire({
                             icon: "error",
                             title: "เกิดข้อผิดพลาดในการลบข้อมูล",
                             confirmButtonText: "ปิด"
                         });
                         return false
                     }
                     posts.value = posts.value.filter(item => item.id !== id)
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "ลบข้อมูลเรียบร้อย",
                         showConfirmButton: false,
                         timer: 1500
                     });
                     $('#deleteModal').modal('hide')

                 } catch (error) {
                     console.error(error);
                     Swal.fire({
                         icon: "error",
                         title: "เกิดข้อผิดพลาดในการลบข้อมูล",
                         confirmButtonText: "ปิด"
                     });
                 }
             }
             const closeDialog = () => {
                 formState.value = {
                     ...initState
                 }
             }
             onMounted(() => {
                 fetchData()
             })
             return {
                 fetchData,
                 posts,
                 deleteItem,
                 modalDelete,
                 showObj,
                 openDialog,
                 formState,
                 onCreateSubmit,
                 onUpdateSubmit,
                 updateData,
                 closeDialog
             }
         }
     }).mount('#app')
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
 </body>

 </html>