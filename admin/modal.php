<!-- Add Modal -->
<div class="modal fade" id="myCategoryModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Enter a new Category</h5>
        </div>
        <div class="modal-body">
            <form action="#" method="POST">
            <input type="hidden" name="CategoryIdAdd" id="CategoryIdAdd">
                <div class="form-floating mb-3">
                    <input type="text" name="AddCategoryName" class="form-control" id="AddCategoryName" placeholder="Category Name">
                    <label for="floatingInput">Category Name</label>
                </div>          
                <div class="float-end">
                    <button type="submit" class="btn btn-dark">Add Task</button>
                </div>
            </form>  
            
        </div>
        
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="myCategoryEditModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Edit the Category</h5>
        </div>
        <div class="modal-body">
            <form action="#" method="POST">
                <input type="hidden" name="CategoryId" id="CategoryId">
                <div class="form-floating mb-3">
                    <input type="text" name="EditCategoryName" class="form-control" id="EditCategoryName">
                    <label for="floatingInput">Task Name</label>
                </div>             
                <div class="float-end">
                    <button type="submit" class="btn btn-dark">Update Task</button>
                </div>
            </form>  
            
        </div>
        
        </div>
    </div>
</div>
