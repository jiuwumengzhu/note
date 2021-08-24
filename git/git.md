git init  初始化



git add filename  将文件添加到暂存区



git status 查看暂存区状态



git commit -m "说明"  将文件提交到分支



git checkout -- filename 丢弃工作区的修改

`git checkout`其实是用版本库里的版本替换工作区的版本，无论工作区是修改还是删除，都可以“一键还原”。

git reset HEAD filename 将暂存区的内容撤销掉，重新放入工作区



git rm filename 删除文件

git commit -m "注释说明" 版本库中删除该文件



关联一个远程库，使用命令`git remote add origin git@server-name:path/repo-name.git`；



创建`dev`分支，然后切换到`dev`分支

```
git checkout -b dev
```

`git checkout`命令加上`-b`参数表示创建并切换

`git branch`命令查看当前分支

`git checkout 分支名称 `  切换分支

`git merge`命令用于合并指定分支到当前分支。

`git switch`命令来切换分支

创建并切换到新的`dev`分支，可以使用：

```
$ git switch -c dev
```