<template>
    <div class="content-search-panel">
        <form class="row align-items-end">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="id" class="form-label">Номер расчёта</label>
                        <input type="text" class="form-control" id="id">
                    </div>
        
                    <div class="col-lg-4">
                        <label for="body" class="form-label">Корпус</label>
                        <input type="text" class="form-control" id="body">
                    </div>
        
                    <div class="col-lg-4">
                        <label for="author" class="form-label">Автор</label>
                        <input type="text" class="form-control" id="author">
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary w-100">Найти</button>
            </div>
        </form>
    </div>
</template>