  SELECT P.[LastName]
,P.[FirstName]
  FROM [beta_torresmartinez].[PersonModule].[Person] P
  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
  ON P.[PersonID] = S.[PersonID]
  WHERE RIGHT(SSN,4) = 4514


  SELECT [TANFCaseID]
,C.[HouseholdID]
,M.[PersonID]
,P.[FirstName]
,P.[LastName]
,S.[SSN]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase] C
  JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] M
  ON C.[HouseholdID] = M.[HouseholdID]
  JOIN [beta_torresmartinez].[PersonModule].[Person] P
  ON M.[PersonID] = P.[PersonID]
  JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
  ON M.[PersonID] = S.[PersonID]
  WHERE [TANFCaseID] = 5


-- not working
SELECT [TANFCaseID]
,[beta_torresmartinez].[TANFCaseModule].[TANFCase].[HouseholdID]
,[beta_torresmartinez].[HouseholdModule].[Household].[HeadOfHouseholdMemberID]
,[beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID]
,[beta_torresmartinez].[PersonModule].[Person].[FirstName], [LastName]
--,[beta_torresmartinez].[PersonSSNModule].[Person].[SSN]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase]
  JOIN [beta_torresmartinez].[HouseholdModule].[Household]
  ON [beta_torresmartinez].[TANFCaseModule].[TANFCase].[HouseholdID] = [beta_torresmartinez].[HouseholdModule].[Household].[HouseholdID]
  JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember]
  ON [beta_torresmartinez].[TANFCaseModule].[TANFCase].[HouseholdID] = [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[HouseholdID]
  JOIN [beta_torresmartinez].[PersonModule].[Person]
  ON [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID] = [beta_torresmartinez].[PersonModule].[Person].[PersonID]
  --JOIN [beta_torresmartinez].[PersonSSNModule].[Person]
  --ON [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID] = [beta_torresmartinez].[PersonSSNModule].[Person].[PersonID]
  WHERE [TANFCaseID] = 5


-- not working
SELECT [TANFCaseID]
,[beta_torresmartinez].[TANFCaseModule].[TANFCase].[HouseholdID]
,[beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID]
,[beta_torresmartinez].[PersonModule].[Person].[FirstName]
,[beta_torresmartinez].[PersonModule].[Person].[LastName]
--,[beta_torresmartinez].[PersonSSNModule].[SSN]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase]
  JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember]
  ON [beta_torresmartinez].[TANFCaseModule].[TANFCase].[HouseholdID] = [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[HouseholdID]
  JOIN [beta_torresmartinez].[PersonModule].[Person]
  ON [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID] = [beta_torresmartinez].[PersonModule].[Person].[PersonID]
  --JOIN [beta_torresmartinez].[PersonSSNModule].[Person]
  --ON [beta_torresmartinez].[HouseholdModule].[HouseholdMember].[PersonID] = [beta_torresmartinez].[PersonSSNModule].[Person].[PersonID]
  WHERE [TANFCaseID] = 5


SELECT [TANFCaseID]
      ,[HouseholdID]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase] --C


SELECT [HouseholdID]
      ,[HeadOfHouseholdMemberID]
  FROM [beta_torresmartinez].[HouseholdModule].[Household] --H


SELECT [HouseholdMemberID]
      ,[HouseholdID]
      ,[PersonID]
  FROM [beta_torresmartinez].[HouseholdModule].[HouseholdMember] --M


SELECT [PersonID]
      ,[FirstName]
      ,[LastName]
  FROM [beta_torresmartinez].[PersonModule].[Person] --P


SELECT [PersonID]
      ,[SSN]
  FROM [beta_torresmartinez].[PersonSSNModule].[Person] --S