from random import choice, randint


gradeSala2 = [
    ["mat", "mat", "hist"], # segunda
    ["mat", "mat", "quim"], # terça
    ["port", "port", "hist"], # quarta
    ["port","port","quim"], # quinta
    ['-', '-', '-']  # sexta
]


def gerarGrade(materia: list, quantAulas: int):
    materia = materia.copy()
    grade = [["-" for a in range(quantAulas)] for i in range(5)]
    
    for dia in range(len(grade)):
        for mat in range(len(grade[dia])):
            if materia == []:
                grade[dia][mat] = "--"
            else:
                materiaAleatoria = choice(materia)
                grade[dia][mat] = materiaAleatoria
                materia.remove(materiaAleatoria)
    return grade

def mostrarGrade(grade: list):
    for e in grade:
        print("[")
        for i in e:
            print(i,end=", ")
        print()
        print("]")

# inicio da analise da qualidade da grade

def validarGrade(grade: list, materias: list):
    pontos = 0
    
    pontos += mesmoDia(grade, materias)
    pontos += aulasSeguidas(grade)
    
    return pontos

def profIguais(grade: list):
    iguais = 0 #Ruim
    diferentes = 0 # Bom
    for i in range(len(grade)):
        for a in range(len(grade[i])):
            if grade[i][a] == gradeSala2[i][a]:
                # print("posição",i,a,":", grade[i][a], "==", gradeSala2[i][a])
                iguais += 1
            else:
                # print("posição",i,a,":", "errooooo")
                diferentes += 1
    
    return [iguais, diferentes]

def mesmoDia(grade: list, materia: list):
    matSimp = set(materia)
    total = 0
    for e in matSimp:
        for i in grade:
            if i.count(e) > 1:
                total += 1
    return total

def aulasSeguidas(grade: list):
    total = 0
    for i in grade:
        for a in range(len(i)):
            if a != len(i)-1:
                if i[a] == i[a+1]:
                    total += 1
    return total

# treinamentos e alteração da grade

def removerConflitos(grade):
    cont = 0
    gradem = mutargrade(grade)
    mats = profIguais(gradem)
    # print("iguais:", mats[0])
    # print("diferentes uhuu:", mats[1])
    while mats[0] != 0:
        cont += 1
        gradem = mutargrade(gradem)
        mats = profIguais(gradem)
        # print("iguais:", mats[0])
        # print("diferentes uhuu:", mats[1])
    
    return [gradem, cont]

def mutargrade(grade: list):
    rand1 = randint(0, len(grade)-1)
    rand2 = randint(0, quantAulasDia-1)
    
    rand3 = randint(0, len(grade)-1)
    rand4 = randint(0, quantAulasDia-1)
    
    apoio = grade[rand1][rand2]
    grade[rand1][rand2] = grade[rand3][rand4]
    grade[rand3][rand4] = apoio
    
    return grade

def avacarGeracao(grade: list, materia: list, quantGeracoes: int, quantIndividuos: int):
    listaInd = ['' for i in range(quantIndividuos)]
    melhorInd = grade
    for gera in range(quantGeracoes):
        for ind in range(quantIndividuos):
            listaInd[ind] = mutargrade(grade)
        for indv in listaInd:
            if validarGrade(melhorInd, materia) < validarGrade(indv, materia):
                melhorInd = indv
    return melhorInd
        

materias = [
    "mat",
    "mat",
    "mat",
    "mat",
    "port",
    "port",
    "port",
    "port",
    "hist",
    "hist",
    "quim",
    "quim"
]

# testes
quantAulasDia = 3
pontuacao = 0

grade1 = gerarGrade(materias, quantAulasDia)
mostrarGrade(grade1)

print("pontuação da grade 1:", validarGrade(grade1,materias))

mats = profIguais(grade1)
print("iguais:", mats[0])
print("diferentes uhuu:", mats[1])

gradeMutada = avacarGeracao(grade1, materias, 2, 5)

# mostrarGrade(gradeMutada)
print("pontuação da grade mutada:", validarGrade(gradeMutada,materias))

mats = profIguais(gradeMutada)
print("iguais:", mats[0])
print("diferentes uhuu:", mats[1])


# gradeSemConflitos = removerConflitos(grade1)
# mostrarGrade(gradeSemConflitos[0])
# print("quantidade de tentativas para achar:", gradeSemConflitos[1])

# mostrarGrade()