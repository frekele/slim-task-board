# API

## USER:

### POST /sign-in

### POST /sign-up

### GET /validate-token


## BOARD:

### POST /board (insert)

### PUT /board/{id} (update)

### DELETE /board/{id} (delete)

### GET /board (find all)

### GET /board/{id} (find by id)

### GET /board/{id}?eager=true (find by id Eager-mode)


## COLUMN:

### POST /column (insert)

### PUT /column/{id} (update)

### DELETE /column/{id} (delete)

### GET /column (find all)

### GET /column/{id} (find by id)

### GET /column/{id}?eager=true (find by id - Eager-mode)

### GET /column/board/{boardId} (find by boardId)

### GET /column/board/{boardId}?eager=true (find by boardId - Eager-mode)


## TASK:

### POST /task (insert)

### PUT /task/{id} (update)

### DELETE /task/{id} (delete)

### GET /task (find all)

### GET /task/{id} (find by id)

### GET /task/column/{columnId} (find by columnId)

### GET /task/assigned-user/{assignedUserId} (find by assignedUserId)


# For TEST:

- https://slim-task-board.herokuapp.com/
